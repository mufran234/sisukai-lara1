@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Pricing</h1>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Free</h2>
            <p class="text-gray-600 my-3">1 active certification • Limited practice</p>
            <p class="text-2xl font-bold mb-4">$0</p>
            <a href="{{ route('register') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Get Started</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border-2 border-emerald-600">
            <h2 class="text-xl font-semibold">Pro</h2>
            <p class="text-gray-600 my-3">All certifications • Full exams • Explanations</p>
            <p class="text-2xl font-bold mb-4">$29 / 3 months</p>
            <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-4 py-2 rounded">Upgrade</a>
        </div>
    </div>
</div>
@endsection
