<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($surveyId)
    {
        $survey = Survey::findOrFail($surveyId);
        return view('survey.add-question', compact('survey'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'text' => 'required|string|max:255',
            'type' => 'required|in:text,single_choice,multiple_choice',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string|max:255',
        ]);
        $question = new Question();
        $question->survey_id = $validated['survey_id'];
        $question->text = $validated['text'];
        $question->type = $validated['type'];
        $question->save();

        if (in_array($question->type, ['single_choice', 'multiple_choice']) && $request->has('options')) {
            foreach ($validated['options'] as $optionText) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->text = $optionText;
                $option->save();
            }
        }
        return redirect()->route('surveys.add-question', ['surveyId' => $validated['survey_id']])
            ->with('status', 'Question added successfully!');
    }

    public function addQuestion($surveyId)
    {
        $survey = Survey::find($surveyId);
        if (!$survey) {
            return redirect()->route('surveys.index')->with('error', 'Survey not found.');
        }
        return view('surveys.add-question', ['surveyId' => $surveyId]);
    }
}
