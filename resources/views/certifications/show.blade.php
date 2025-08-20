@extends('layouts.app')

@section('title', $certification->name)

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <h1 class="text-2xl font-bold text-indigo-700">{{ $certification->name }}</h1>
    <p class="text-gray-600">{{ $certification->description }}</p>

    <!-- Actions -->
    <div class="flex space-x-4 mt-4">
        <x-button>Take Diagnostic Test</x-button>
        <x-button class="bg-purple-600 hover:bg-purple-700">Practice by Topic</x-button>
        <x-button class="bg-green-600 hover:bg-green-700">Full Exam Simulation</x-button>
    </div>

    <!-- Domain Progress -->
    <x-card>
        <h2 class="font-semibold mb-4">Progress by Domain</h2>
        @foreach($certification->domains as $domain)
            <div class="mb-3">
                <p class="font-medium">{{ $domain->name }}: {{ $domain->progress }}%</p>
                <x-progress-bar :value="$domain->progress"/>
            </div>
        @endforeach
    </x-card>

    <!-- Weakest Topics -->
    <x-card>
        <h2 class="font-semibold mb-4">Recommended Focus Areas</h2>
        <div class="space-y-2">
            <x-weak-topic topic="Stakeholder Engagement"/>
            <x-weak-topic topic="Risk Management"/>
            <x-weak-topic topic="Quality Control"/>
        </div>
    </x-card>
</div>
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-4">{{ $cert->name }}</h1>
    <p class="mb-6">{{ $cert->description }}</p>

    @foreach($cert->domains as $domain)
        <div class="mb-4 p-4 border rounded-lg bg-white shadow">
            <h2 class="font-semibold text-xl">{{ $domain->name }}</h2>
            <ul class="list-disc ml-6 mt-2">
                @foreach($domain->topics as $topic)
                    <li>{{ $topic->name }} ({{ $topic->questions->count() }} questions)</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">{{ $cert->name }}</h1>
    <p class="mb-6 text-gray-700">{{ $cert->description }}</p>

    <!-- Take Practice Exam Button -->
    <div class="mb-6">
        <a href="{{ route('certifications.exam.start', $cert->slug) }}"
           class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow transition">
           🎯 Take Practice Exam
        </a>
    </div>

    <!-- Domains and Topics -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">Domains & Topics</h2>
        @forelse($cert->domains as $domain)
            <div class="mb-6 p-4 border rounded-lg bg-white shadow">
                <h3 class="font-semibold text-xl mb-2">{{ $domain->name }}</h3>
                <ul class="list-disc ml-6 text-gray-600">
                    @foreach($domain->topics as $topic)
                        <li>
                            {{ $topic->name }}
                            <span class="text-sm text-gray-500">
                                ({{ $topic->questions->count() }} questions)
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-gray-500">No domains or topics available yet for this certification.</p>
        @endforelse
    </div>
</div>
@endsection
