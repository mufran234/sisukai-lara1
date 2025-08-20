@extends('admin.layout')
@section('admin')
<h1 class="text-2xl font-bold mb-4">Add Question</h1>
<form method="POST" action="{{ route('admin.questions.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-4">
  @csrf
  <label class="block">
    <span class="text-sm font-medium">Certification</span>
    <select name="certification_id" class="mt-1 w-full border rounded-lg p-2">
      @foreach($certs as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
    </select>
  </label>

  <label class="block">
    <span class="text-sm font-medium">Domain</span>
    <select name="domain_id" class="mt-1 w-full border rounded-lg p-2">
      @foreach($domains as $d)<option value="{{ $d->id }}">{{ $d->certification->name }} — {{ $d->name }}</option>@endforeach
    </select>
  </label>

  <label class="block">
    <span class="text-sm font-medium">Topic</span>
    <select name="topic_id" class="mt-1 w-full border rounded-lg p-2">
      @foreach($topics as $t)<option value="{{ $t->id }}">{{ $t->domain->name }} — {{ $t->name }}</option>@endforeach
    </select>
  </label>

  @include('admin.partials._field',['label'=>'Question Text','name'=>'question_text','type'=>'textarea'])

  <div class="border rounded-xl p-4">
    <p class="font-medium mb-2">Answers (MCQ, mark the correct one):</p>
    @for($i=0;$i<4;$i++)
      <div class="flex items-center gap-3 mb-2">
        <input type="checkbox" name="answers[{{ $i }}][is_correct]" value="1">
        <input type="text" name="answers[{{ $i }}][text]" class="w-full border rounded p-2" placeholder="Answer option {{ $i+1 }}">
      </div>
    @endfor
  </div>

  <x-button type="submit">Create</x-button>
</form>
@endsection
