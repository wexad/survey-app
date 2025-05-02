<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Response;
use App\Models\Survey;
use App\Models\Option;
use Illuminate\Http\Request;
use Ramsey\Uuid\Nonstandard\Uuid;

class SurveyController extends Controller
{

    public function index()
    {
        $surveys = Survey::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $survey = new Survey();
        $survey->title = $validated['title'];
        $survey->description = $validated['description'];
        $survey->user_id = auth()->user()->id;
        $survey->save();
        return redirect()->route('surveys.add-question', ['surveyId' => $survey->id]);
    }

    public function show($surveyId)
    {
        $survey = Survey::with('questions')->findOrFail($surveyId);
        return view('surveys.show', compact('survey'));
    }

    public function showStatistics(Request $request, int $surveyId)
    {
        $survey = Survey::with('questions.options.answers')->findOrFail($surveyId);
        $statistics = [];

        foreach ($survey->questions as $question) {
            $stat = [
                'question' => $question->text,
            ];

            if ($question->type === 'text') {
                $stat['texts'] = $question->answers()->whereNotNull('text')->pluck('text')->toArray();
            } else {
                $totalAnswers = $question->answers()->count();
                $optionStats = [];

                foreach ($question->options as $option) {
                    $count = $option->answers()->count();
                    $percentage = $totalAnswers > 0 ? round(($count / $totalAnswers) * 100, 2) : 0;
                    $optionStats[] = [
                        'answer' => $option->text,
                        'count' => $count,
                        'percentage' => $percentage,
                    ];
                }

                $stat['options'] = $optionStats;
            }

            $statistics[] = $stat;
        }

        return view('surveys.statistics', [
            'surveyTitle' => $survey->title,
            'statistics' => $statistics,
        ]);
    }


    public function submit(Request $request, int $surveyId)
    {
        $response = new Response();
        $response->survey_id = $surveyId;
        $response->guest_uuid = Uuid::uuid4();
        $response->save();
        $data = $request->input('answers');
        foreach ($data as $questionId => $answer) {
            if (is_array($answer)) {
                foreach ($answer as $optionId) {
                    Answer::create([
                        'response_id' => $response->id,
                        'question_id' => $questionId,
                        'option_id' => $optionId,
                        'text' => null,
                    ]);
                }
            } else {
                Answer::create([
                    'response_id' => $response->id,
                    'question_id' => $questionId,
                    'option_id' => Option::find($answer) ? $answer : null,
                    'text' => Option::find($answer) ? null : $answer,
                ]);
            }
        }
        return redirect()->route('finish');
    }

    public function finish()
    {
        return view('finish');
    }

}
