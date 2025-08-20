<x-app-layout>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Welcome back, {{ auth()->user()->name }}</h1>

    <h2 class="font-semibold mb-2">Active Certifications</h2>
    <div class="grid sm:grid-cols-3 gap-4 mb-8">
      @php $activeIds = collect($active)->pluck('certification_id'); @endphp
      @forelse($active as $uc)
        <x-cert-card :cert="$uc->certification" active />
      @empty
        <div class="text-gray-500">No active certifications. Activate one below.</div>
      @endforelse
    </div>

    <h2 class="font-semibold mb-2">Explore Certifications</h2>
    <div class="grid sm:grid-cols-4 gap-4">
      @foreach($all as $cert)
        <x-cert-card :cert="$cert" :locked="auth()->user()->tier==='free' && !$activeIds->contains($cert->id)"/>
      @endforeach
    </div>
  </div>
</x-app-layout>
