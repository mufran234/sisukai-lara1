@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-8">

    <!-- Welcome + Streak -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}</h1>
        <x-streak :count="3" />
    </div>

    <!-- Active Certifications -->
    <x-card>
        <h2 class="font-semibold mb-4">Your Active Certifications</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-card>
                <h3 class="text-lg font-semibold">PMP</h3>
                <x-progress-bar :value="45"/>
                <p class="text-sm mt-2 text-gray-600">Progress: 45%</p>
                <x-button class="mt-3">Continue</x-button>
            </x-card>

            <x-card>
                <h3 class="text-lg font-semibold">AWS SAA</h3>
                <x-progress-bar :value="20"/>
                <p class="text-sm mt-2 text-gray-600">Progress: 20%</p>
                <x-button class="mt-3">Continue</x-button>
            </x-card>
        </div>
    </x-card>

    <!-- Coming Soon -->
    <x-card>
        <h2 class="font-semibold mb-4">Other Certifications (Coming Soon)</h2>
        <div class="flex flex-wrap gap-2">
            <x-badge>ITIL Foundation</x-badge>
            <x-badge>CISSP</x-badge>
            <x-badge>Azure Fundamentals</x-badge>
            <x-badge>CCNA</x-badge>
        </div>
    </x-card>

    <!-- Upgrade Banner -->
    <x-upgrade-banner />
</div>
@endsection
