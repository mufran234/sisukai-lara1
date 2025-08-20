@props(['cert','active'=>false,'locked'=>false])
<div class="border rounded-xl p-4 relative">
  <div class="text-lg font-semibold">{{ $cert->name }}</div>
  <div class="text-xs text-gray-500">{{ $cert->duration }} min exam</div>

  @if($locked)
    <div class="absolute inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center rounded-xl">
      <div class="text-sm">Upgrade to Pro</div>
    </div>
  @endif

  <div class="mt-3 flex gap-2">
    <a href="{{ route('certifications.show',$cert) }}" class="text-indigo-600 text-sm">View</a>
    @unless($active)
      <form method="POST" action="{{ route('certifications.activate',$cert) }}">
        @csrf
        <button class="text-sm underline">Activate</button>
      </form>
    @endunless
  </div>
</div>

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-md p-6']) }}>
    {{ $slot }}
</div>
