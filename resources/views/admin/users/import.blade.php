@extends('admin.layout')
@section('admin')
<h1 class="text-2xl font-bold mb-4">Import Questions (JSON)</h1>
@include('components.flash')

<form method="POST" action="{{ route('admin.import.json') }}" enctype="multipart/form-data" class="bg-white rounded-2xl shadow p-6 space-y-4">
  @csrf
  <label class="block mb-4">
    <span class="text-sm font-medium">Certification</span>
    <select name="certification_id" class="mt-1 w-full border rounded-lg p-2">
      @foreach(\App\Models\Certification::orderBy('name')->get() as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </label>

  <label class="block mb-4">
    <span class="text-sm font-medium">Domain (optional)</span>
    <select name="domain_id" class="mt-1 w-full border rounded-lg p-2">
      <option value="">— None —</option>
      @foreach(\App\Models\Domain::orderBy('name')->get() as $d)
        <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->certification->name }})</option>
      @endforeach
    </select>
  </label>

  <label class="block mb-4">
    <span class="text-sm font-medium">Topic (optional)</span>
    <select name="topic_id" class="mt-1 w-full border rounded-lg p-2">
      <option value="">— None —</option>
      @foreach(\App\Models\Topic::orderBy('name')->get() as $t)
        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->domain->name }})</option>
      @endforeach
    </select>
  </label>

  <label class="block mb-4">
    <span class="text-sm font-medium">Upload JSON File</span>
    <input type="file" name="json_file" accept="application/json" required class="mt-1 w-full">
  </label>

  <p class="text-sm text-gray-600">JSON format example:</p>
  <pre class="bg-gray-100 p-2 rounded text-xs">
[
  {"question_text":"Sample question","options":["A","B","C","D"],"correct_index":1,"explanation":"Explanation text"}
]
  </pre>

  <x-button type="submit">Import</x-button>
</form>
@endsection
