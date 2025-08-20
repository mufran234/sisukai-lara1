@extends('layouts.app')

@section('title', 'Results')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Confetti Celebration -->
    <x-confetti />

    <h1 class="text-2xl font-bold text-indigo-700">Results: PMP Exam Simulation</h1>

    <!-- Overall Score -->
    <x-card>
        <p class="text-xl font-bold">Overall Score: 65%</p>
        <x-progress-ring :value="65"/>
    </x-card>

    <!-- Domain Breakdown -->
    <x-card>
        <h2 class="font-semibold mb-4">Domain Performance</h2>
        <div class="space-y-3">
            <p>People: <x-progress-bar :value="70"/></p>
            <p>Process: <x-progress-bar :value="55"/></p>
            <p>Business Env: <x-progress-bar :value="60"/></p>
        </div>
    </x-card>

    <!-- Recommendations -->
    <x-card>
        <h2 class="font-semibold mb-4">Recommended Focus</h2>
        <x-weak-topic topic="Process Domain"/>
        <x-weak-topic topic="Stakeholder Engagement"/>
    </x-card>

    <!-- Next Actions -->
    <div class="flex space-x-4">
        <x-button class="bg-green-600 hover:bg-green-700">Retry Exam</x-button>
        <x-button class="bg-purple-600 hover:bg-purple-700">Practice Weakest Topics</x-button>
    </div>
</div>
@endsection
