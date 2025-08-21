@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto text-center py-10">
    <h1 class="text-3xl font-bold mb-6">Exam Results</h1>
    <p class="text-lg">Certification: <span class="font-semibold">{{ $cert->name }}</span></p>
    <p class="text-lg">Score: <span class="font-bold {{ $score >= 70 ? 'text-green-600' : 'text-red-600' }}">{{ $score }}%</span></p>
    <p class="text-lg">Time Taken: {{ $timeTaken ?? 'N/A' }} minutes</p>

    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Your Weakest Topics</h2>
        <ul class="list-disc list-inside text-left inline-block">
            @forelse($weakest as $topic)
                <li>{{ $topic['name'] }} ({{ $topic['wrong'] }}/{{ $topic['total'] }} wrong)</li>
            @empty
                <li>Great work! No weak topics detected.</li>
            @endforelse
        </ul>
    </div>

    <div class="mt-8 flex justify-center gap-4">
        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Dashboard</a>
        <a href="{{ route('exams.take', $cert->slug) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Retake Exam</a>
    </div>
</div>
@endsection
