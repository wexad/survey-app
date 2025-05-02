<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Survey: {{ $survey->title }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <p class="text-gray-600 mb-6">{{ $survey->description }}</p>

            <form method="POST" action="{{ route('surveys.submit', $survey->id) }}">
                @csrf

                <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                @foreach($survey->questions as $question)
                <div class="mb-6">
                    <label class="font-semibold block mb-2">{{ $question->text }}</label>

                    @if($question->type === 'text')
                    <textarea name="answers[{{ $question->id }}]" required
                              class="w-full border rounded p-2"></textarea>

                    @elseif($question->type === 'single_choice')
                    @foreach($question->options as $option)
                    <div class="mb-1">
                        <input type="radio" name="answers[{{ $question->id }}]"
                               value="{{ $option->id }}" required>
                        <label>{{ $option->text }}</label>
                    </div>
                    @endforeach

                    @elseif($question->type === 'multiple_choice')
                    @foreach($question->options as $option)
                    <div class="mb-1">
                        <input type="checkbox" name="answers[{{ $question->id }}][]"
                               value="{{ $option->id }}">
                        <label>{{ $option->text }}</label>
                    </div>
                    @endforeach
                    @endif
                </div>
                @endforeach

                <button type="submit" class="bg-black text-white px-4 py-2 rounded">
                    Submit Survey
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
