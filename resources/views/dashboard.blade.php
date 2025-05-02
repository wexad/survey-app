<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asosiy oyna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-6">
                        <a href="{{ route('surveys.create') }}"
                           class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                            Yangi anketa yaratish
                        </a>
                    </div>
                    <div class="mt-6">
                        <table class="min-w-full bg-white shadow-md rounded-lg">
                            <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2 border-b">Anketa nomi</th>
                                <th class="px-4 py-2 border-b">Link</th>
                                <th class="px-4 py-2 border-b">Statistika</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($surveys as $survey)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $survey->title }}</td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ url('/form/' . $survey->id) }}" class="text-blue-500 hover:underline">
                                        Formaga kirish
                                    </a>
                                </td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ url('/form/' . $survey->id . '/statistic') }}"
                                       class="text-blue-500 hover:underline">
                                        Statistikalarni ko'rish
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
