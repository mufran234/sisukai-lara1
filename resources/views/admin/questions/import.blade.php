@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Import Questions</h1>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded mb-6">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.questions.import') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Certification</label>
            <select name="certification_id" class="mt-1 w-full border rounded p-2" required>
                @foreach($certs as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Topic Name</label>
            <input type="text" name="topic_name" class="mt-1 w-full border rounded p-2" placeholder="e.g., Stakeholder Management" required>
        </div>
        <div>
            <label class="block font-medium">File (JSON or CSV)</label>
            <input type="file" name="file" class="mt-1 w-full" accept=".json,.csv,.txt" required>
            <p class="text-xs text-gray-500 mt-1">
                JSON: [{ "question": "...", "options": ["A","B","C"], "correct_answer": "A", "explanation": "..." }, ...]<br>
                CSV: question, option1|option2|..., correct_answer, explanation
            </p>
        </div>
        <button class="bg-emerald-600 text-white px-4 py-2 rounded">Import</button>
    </form>
</div>
@endsection
