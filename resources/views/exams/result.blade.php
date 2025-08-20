<x-app-layout>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-2">Result — {{ $attempt->certification->name }}</h1>
    <div class="text-gray-600 mb-4">Score: <span class="font-semibold">{{ $attempt->score }}%</span></div>

    <h2 class="font-semibold mt-4 mb-2">Domain Breakdown</h2>
    <div class="grid sm:grid-cols-3 gap-4">
      @foreach($domainStats as $d)
        <div class="border rounded-xl p-4">
          <div class="font-semibold">{{ $d['name'] }}</div>
          <div class="text-2xl">{{ $d['score'] }}%</div>
        </div>
      @endforeach
    </div>

    <h2 class="font-semibold mt-6 mb-2">Weakest Topics</h2>
    <ul class="list-disc list-inside text-gray-700">
      @foreach($weakest as $w)
        <li>{{ $w['name'] }} — {{ $w['score'] }}%</li>
      @endforeach
    </ul>

    <div class="mt-6 flex gap-3">
      <a href="{{ route('certifications.show',$attempt->certification) }}" class="px-4 py-2 border rounded-lg">Practice Again</a>
      <a href="{{ route('dashboard') }}" class="px-4 py-2 border rounded-lg">Back to Dashboard</a>
    </div>
  </div>
</x-app-layout>
