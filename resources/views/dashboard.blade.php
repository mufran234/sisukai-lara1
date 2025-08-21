@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Your Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($certs as $cert)
        <div class="bg-white shadow rounded-xl p-6 text-center border hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-2">{{ $cert->name }}</h2>
            <p class="text-gray-500 mb-4">{{ $cert->description ?? 'Certification exam prep' }}</p>

            @if($cert->progress)
                <div class="mb-4">
                    <p class="text-sm">First: {{ $cert->progress['first'] }}%</p>
                    <p class="text-sm">Last: {{ $cert->progress['last'] }}%</p>
                    <p class="text-sm">Best: {{ $cert->progress['best'] }}%</p>
                    <div class="w-full bg-gray-200 rounded-full h-3 mt-2">
                        <div class="bg-green-500 h-3 rounded-full" style="width: {{ $cert->progress['last'] }}%"></div>
                    </div>
                </div>
                <a href="{{ route('exams.take', $cert->slug) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Continue
                </a>
            @else
                <div class="mb-4 text-gray-400">No attempts yet</div>
                <a href="{{ route('exams.take', $cert->slug) }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Start Exam
                </a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
