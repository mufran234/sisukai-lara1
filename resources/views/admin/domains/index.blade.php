@extends('admin.layout')
@section('admin')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Domains</h1>
  <a href="{{ route('admin.domains.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Add</a>
</div>

@include('components.flash')

<x-card>
  @include('admin.partials._table', ['headers'=>['Name','Certification','Weight']])
    @foreach($domains as $d)
      <tr>
        <td class="px-4 py-3">{{ $d->name }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $d->certification->name }}</td>
        <td class="px-4 py-3">{{ $d->weight ?? '—' }}</td>
        <td class="px-4 py-3 text-right">
          <a href="{{ route('admin.domains.edit',$d) }}" class="text-indigo-600">Edit</a>
          <form action="{{ route('admin.domains.destroy',$d) }}" method="POST" class="inline"
                onsubmit="return confirm('Delete domain?')">
            @csrf @method('DELETE')
            <button class="ml-3 text-red-600">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </x-card>

<div class="mt-4">{{ $domains->links() }}</div>
@endsection
