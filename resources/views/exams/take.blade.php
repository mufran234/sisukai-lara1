<x-app-layout>
  <div class="max-w-5xl mx-auto p-6"
       x-data="{ endsAt: new Date('{{ $endsAt }}'), timeleft:'' }"
       x-init="setInterval(()=>{ let s=(endsAt - new Date())/1000; if(s<=0){ $refs.examForm.submit(); } else { let m=Math.floor(s/60), r=Math.floor(s%60); timeleft=m+'m '+r+'s'; } }, 1000)">
    <div class="flex items-center justify-between">
      <h1 class="text-xl font-semibold">{{ $attempt->certification->name }} — {{ strtoupper($attempt->attempt_type) }}</h1>
      <div class="px-3 py-1 bg-gray-100 rounded text-sm">Time left: <span x-text="timeleft"></span></div>
    </div>

    <form method="POST" action="{{ route('exam.submit',$attempt) }}" x-ref="examForm" class="mt-6 space-y-6">
      @csrf
      @foreach($questions as $i=>$q)
        <div class="border rounded-xl p-4">
          <div class="font-semibold mb-2">{{ $i+1 }}. {!! nl2br(e($q->question_text)) !!}</div>
          @foreach($q->answers as $a)
            <label class="flex items-center gap-2 mb-1">
              <input type="radio" name="answers[{{ $q->id }}]" value="{{ $a->id }}" class="rounded">
              <span>{{ $a->answer_text }}</span>
            </label>
          @endforeach
        </div>
      @endforeach

      <div class="flex justify-end">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Submit Exam</button>
      </div>
    </form>
  </div>
</x-app-layout>
