<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $surveyTitle }} uchun statistika
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto bg-white p-6 rounded shadow">
        @foreach($statistics as $stat)
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">{{ $stat['question'] }}</h3>
            @if(isset($stat['options']))
            <ul class="pl-4 list-disc text-gray-700">
                @foreach($stat['options'] as $opt)
                <li>
                    {{ $opt['answer'] }} — {{ $opt['count'] }} ovoz ({{ $opt['percentage'] }}%)
                </li>
                @endforeach
            </ul>
            @elseif(isset($stat['texts']))
            <ul class="pl-4 list-disc text-gray-700">
                @foreach($stat['texts'] as $text)
                <li>"{{ $text }}"</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endforeach
    </div>
</x-app-layout>
