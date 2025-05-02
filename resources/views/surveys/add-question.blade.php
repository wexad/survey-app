<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Savol qo'shish") }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('questions.store') }}">
                @csrf
                <input type="hidden" name="survey_id" value="{{ $surveyId }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="text">Savol matni</label>
                    <input type="text" name="text" id="text" required
                           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="type">Savol turi</label>
                    <select name="type" id="type" required class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                        <option value="text">Text</option>
                        <option value="single_choice">Single Choice</option>
                        <option value="multiple_choice">Multiple Choice</option>
                    </select>
                </div>
                <div id="options-container" class="mb-4" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700" for="options">Options</label>
                    <div id="options">
                        <div class="flex items-center mb-2 option-input">
                            <input type="text" name="options[]"
                                   class="mt-1 block w-full border-gray-300 rounded shadow-sm" placeholder="Option 1">
                            <button type="button" class="remove-option bg-red-500 text-white px-2 py-1 rounded ml-2">
                                O'chirish
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-option"
                            class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Variant qo'shish
                    </button>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                        Savolni qo'shish
                    </button>
                    <a href="{{ route('surveys.index') }}"
                       class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                        Tugatish
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const questionTypeSelect = document.getElementById('type');
        const optionsContainer = document.getElementById('options-container');
        const addOptionButton = document.getElementById('add-option');
        const optionsDiv = document.getElementById('options');
        questionTypeSelect.addEventListener('change', () => {
            if (questionTypeSelect.value === 'single_choice' || questionTypeSelect.value === 'multiple_choice') {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
        });
        addOptionButton.addEventListener('click', () => {
            const optionInput = document.createElement('div');
            optionInput.classList.add('flex', 'items-center', 'mb-2', 'option-input');
            optionInput.innerHTML = `
                <input type="text" name="options[]"
                       class="mt-1 block w-full border-gray-300 rounded shadow-sm" placeholder="Option">
                <button type="button" class="remove-option bg-red-500 text-white px-2 py-1 rounded ml-2">Remove</button>
            `;
            optionsDiv.appendChild(optionInput);
            optionInput.querySelector('.remove-option').addEventListener('click', () => {
                optionInput.remove();
            });
        });
        document.querySelectorAll('.remove-option').forEach(button => {
            button.addEventListener('click', (e) => {
                e.target.closest('.option-input').remove();
            });
        });
    </script>
</x-app-layout>
