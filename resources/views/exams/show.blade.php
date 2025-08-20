@extends('layouts.app')

@section('title', 'Exam Simulation')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    <!-- Exam Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">PMP Exam Simulation</h1>
        <x-exam-timer :minutes="180" />
    </div>

    <!-- Question -->
    <x-card>
        <p class="font-medium">Q12/200</p>
        <p class="mt-2 text-gray-700">What is the MOST appropriate action for a project manager when...</p>

        <div class="mt-4 space-y-3">
            <label class="flex items-center space-x-2">
                <input type="radio" name="q12" class="text-indigo-600">
                <span>Option A</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="q12" class="text-indigo-600">
                <span>Option B</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="q12" class="text-indigo-600">
                <span>Option C</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="q12" class="text-indigo-600">
                <span>Option D</span>
            </label>
        </div>
    </x-card>

    <!-- Controls -->
    <div class="flex justify-between">
        <x-button class="bg-gray-200 text-gray-800 hover:bg-gray-300">Previous</x-button>
        <div class="space-x-2">
            <x-button class="bg-yellow-500 hover:bg-yellow-600">Flag for Review</x-button>
            <x-button class="bg-green-600 hover:bg-green-700">Next</x-button>
        </div>
    </div>

    <!-- Progress -->
    <x-progress-bar :value="6" />
</div>
@endsection
