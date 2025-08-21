@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Contact</h1>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="mt-1 w-full border rounded p-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="mt-1 w-full border rounded p-2" required>
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-medium">Message</label>
            <textarea name="message" class="mt-1 w-full border rounded p-2" rows="5" required></textarea>
            @error('message') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded">Send</button>
    </form>
</div>
@endsection
