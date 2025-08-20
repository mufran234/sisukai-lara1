<x-app-layout>
  <div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Certifications Library</h1>
      <a href="{{ route('dashboard') }}" class="text-sm underline">My Dashboard</a>
    </div>

    @if($certifications->isEmpty())
      <div class="text-gray-600">No certifications available yet.</div>
    @else
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($certifications as $cert)
          <div class="border rounded-2xl p-5 bg-white shadow-sm">
            <div class="flex items-center justify-between mb-2">
              <h2 class="font-semibold">{{ $cert->name }}</h2>
              @if($cert->duration)<span class="text-xs bg-gray-100 rounded px-2 py-1">{{ $cert->duration }} min</span>@endif
            </div>
            <p class="text-sm text-gray-600 line-clamp-3">{{ $cert->description }}</p>
            <div class="mt-4 flex gap-2">
              <a class="px-3 py-2 border rounded-lg text-sm" href="{{ route('certifications.show',$cert) }}">View</a>
              <form method="POST" action="{{ route('certifications.activate',$cert) }}">
                @csrf
                <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm">Activate</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</x-app-layout>
