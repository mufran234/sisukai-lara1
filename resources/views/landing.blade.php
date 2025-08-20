@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="bg-gradient-to-r from-indigo-50 to-purple-50 py-16">
    <div class="max-w-5xl mx-auto text-center space-y-12">

        <!-- Hero Section -->
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700">
                Duolingo for Certification Prep 🎓
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Practice smarter, simulate exams, and master certifications with SisuKai.
            </p>
            <div class="mt-6 flex justify-center space-x-4">
                <x-button onclick="window.location='{{ url('/register') }}'">Start Free</x-button>
                <x-button class="bg-white text-indigo-600 border border-indigo-600 hover:bg-indigo-50"
                          onclick="window.location='{{ url('/certifications') }}'">
                    View Certifications
                </x-button>
            </div>
        </div>

        <!-- Why SisuKai Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-card>
                <h3 class="font-bold text-indigo-600">📊 Diagnostic Test</h3>
                <p class="text-sm text-gray-600 mt-2">Gauge your readiness and find your weakest areas.</p>
            </x-card>

            <x-card>
                <h3 class="font-bold text-indigo-600">📝 Real Exam Simulations</h3>
                <p class="text-sm text-gray-600 mt-2">Timed tests that mimic the real certification experience.</p>
            </x-card>

            <x-card>
                <h3 class="font-bold text-indigo-600">🎯 Target Weak Spots</h3>
                <p class="text-sm text-gray-600 mt-2">Focus on your weakest topics to improve faster.</p>
            </x-card>

            <x-card>
                <h3 class="font-bold text-indigo-600">🚀 Unlock Pro</h3>
                <p class="text-sm text-gray-600 mt-2">Access all certifications and advanced analytics.</p>
            </x-card>
        </div>

        <!-- Upgrade Banner -->
        <x-upgrade-banner />

        <!-- Footer Quick Links -->
        <div class="mt-12 text-sm text-gray-500">
            <a href="{{ url('/faq') }}" class="hover:text-indigo-600">FAQ</a> ·
            <a href="{{ url('/blog') }}" class="hover:text-indigo-600">Blog</a> ·
            <a href="{{ url('/contact') }}" class="hover:text-indigo-600">Contact</a>
        </div>
    </div>
</div>
@endsection
