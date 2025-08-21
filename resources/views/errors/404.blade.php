@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto text-center py-20">
    <h1 class="text-6xl font-black mb-2">404</h1>
    <p class="text-gray-600 mb-6">We couldn’t find that page.</p>
    <a href="{{ route('landing') }}" class="bg-emerald-600 text-white px-5 py-2 rounded">Go Home</a>
</div>
@endsection
