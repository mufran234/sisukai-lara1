@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-b from-emerald-50 to-white">
    <div class="max-w-5xl mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Certification Prep, Made Simple</h1>
        <p class="text-lg text-gray-600 mb-8">Adaptive exam simulations and focused practice to help you pass with confidence.</p>
        <div class="space-x-3">
            <a href="{{ route('register') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg">Get Started Free</a>
            <a href="{{ route('pricing') }}" class="inline-block bg-white border px-6 py-3 rounded-lg">See Pricing</a>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-lg mb-2">Diagnostic Test</h3>
        <p class="text-gray-600">Gauge readiness instantly and get a personalized practice plan.</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-lg mb-2">Practice Exams</h3>
        <p class="text-gray-600">Realistic timing, detailed explanations, and topic breakdowns.</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-lg mb-2">Track Progress</h3>
        <p class="text-gray-600">See your first, last, and best attempts per certification.</p>
    </div>
</section>
@endsection
