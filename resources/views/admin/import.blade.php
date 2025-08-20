<x-app-layout>
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Import Questions (JSON Paste)</h1>
    <p class="text-sm text-gray-600 mb-4">Paste an array of questions. Each item: { "topic_id":1, "question_text":"...", "options":["A","B","C","D"], "correct_index":0, "explanation":"..." }</p>
    @if(session('status')) <div class="mb-3 text-green-600">{{ session('status') }}</div> @endif
    @if(session('error')) <div class="mb-3 text-red-600">{{ session('error') }}</div> @endif
    <form method="POST" action="{{ route('admin.import.json') }}">
	<label class="block mb-3">
  <span class="text-sm">Certification</span>
  <select name="certification_id" class="w-full border rounded p-2">
    @foreach($certifications as $c)
      <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
  </select>
</label>

<label class="block mb-3">
  <span class="text-sm">Topic</span>
  <select name="topic_id" class="w-full border rounded p-2">
    @foreach($certifications as $c)
      @foreach($c->domains as $d)
        @foreach($d->topics as $t)
          <option value="{{ $t->id }}">{{ $c->name }} — {{ $d->name }} → {{ $t->name }}</option>
        @endforeach
      @endforeach
    @endforeach
  </select>
</label>
      @csrf
      <textarea name="json" rows="12" class="w-full border rounded p-3" placeholder='[{"topic_id":1,"question_text":"...","options":["A","B","C","D"],"correct_index":0}]'></textarea>
      <div class="mt-3">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Import</button>
      </div>
    </form>
  </div>
</x-app-layout>
