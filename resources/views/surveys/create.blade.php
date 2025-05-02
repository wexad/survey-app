<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Anketa yaratish') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('surveys.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="title">Nom</label>
                    <input type="text" name="title" id="title" required
                           class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="description">Tavsif</label>
                    <textarea name="description" id="description" rows="4" required
                              class="mt-1 block w-full border-gray-300 rounded shadow-sm"></textarea>
                </div>
                <div class="flex justify-between">
                    <button type="submit"
                            class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                        Savol qo'shish
                    </button>
                </div>
            </form>
        </div>
</x-app-layout>
