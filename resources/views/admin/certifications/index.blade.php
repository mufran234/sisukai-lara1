@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Certifications</h1>
        <a href="{{ route('admin.certifications.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded">Add</a>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded mb-4">{{ session('status') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left p-3">Name</th>
                    <th class="text-left p-3">Slug</th>
                    <th class="text-left p-3">Duration</th>
                    <th class="text-left p-3">Active</th>
                    <th class="text-left p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($certs as $c)
                    <tr class="border-t">
                        <td class="p-3">{{ $c->name }}</td>
                        <td class="p-3">{{ $c->slug }}</td>
                        <td class="p-3">{{ $c->duration ?? '-' }}</td>
                        <td class="p-3">{{ $c->is_active ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <a class="text-blue-600" href="{{ route('admin.certifications.edit', $c) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('admin.certifications.destroy', $c) }}">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-2" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $certs->links() }}</div>

    <div class="mt-10">
        <a href="{{ route('admin.questions.import.form') }}" class="text-emerald-700 underline">Import Questions</a>
    </div>
</div>
@endsection
