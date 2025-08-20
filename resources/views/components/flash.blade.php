@if(session('status'))
  <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded-lg">{{ session('status') }}</div>
@endif
@if(session('error'))
  <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded-lg">{{ session('error') }}</div>
@endif
