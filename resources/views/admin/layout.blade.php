@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex gap-6">
    <aside class="w-60 shrink-0">
      <div class="bg-white rounded-2xl shadow p-4 space-y-2">
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.home') }}">Overview</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.certifications.index') }}">Certifications</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.domains.index') }}">Domains</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.topics.index') }}">Topics</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.questions.index') }}">Questions</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.users.index') }}">Users</a>
        <a class="block px-3 py-2 rounded hover:bg-gray-100" href="{{ route('admin.import.show') }}">Import (JSON)</a>
      </div>
    </aside>
    <section class="flex-1">
      @yield('admin')
    </section>
  </div>
</div>
@endsection
