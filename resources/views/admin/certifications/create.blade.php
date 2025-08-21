@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Certification</h1>

    <form method="POST" action="{{ route('admin.certifications.store') }}" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="mt-1 w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block font-medium">Slug (optional)</label>
            <input type="text" name="slug" class="mt-1 w-full border rounded p-2">
        </div>
        <div>
            <label class="block font-medium">Duration (minutes)</label>
            <input type="number" name="duration" min="1" class="mt-1 w-full border rounded p-2">
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" checked class="mr-2"> Active
            </label>
        </div>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
