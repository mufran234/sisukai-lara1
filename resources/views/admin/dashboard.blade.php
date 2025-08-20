<x-app-layout>
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Admin</h1>
    <div class="grid sm:grid-cols-3 gap-4">
      <a href="{{ route('admin.users.index') }}" class="border rounded-xl p-4 block">Users</a>
      <a href="{{ route('admin.import') }}" class="border rounded-xl p-4 block">Import Questions (JSON Paste)</a>
    </div>
  </div>
</x-app-layout>
