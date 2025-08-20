@extends('admin.layout')

@section('admin')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Certifications</h1>
  <a href="{{ route('admin.certifications.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Add</a>
</div>

@include('components.flash')

<x-card>
  @include('admin.partials._table', ['headers'=>['Name','Slug','Duration','Active']])
    @foreach($certs as $c)
      <tr>
        <td class="px-4 py-3">{{ $c->name }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $c->slug }}</td>
        <td class="px-4 py-3">{{ $c->duration ?? '—' }}</td>
        <td class="px-4 py-3">{{ $c->is_active ? 'Yes' : 'No' }}</td>
        <td class="px-4 py-3 text-right">
          <a href="{{ route('admin.certifications.edit',$c) }}" class="text-indigo-600">Edit</a>
          <form action="{{ route('admin.certifications.destroy',$c) }}" method="POST" class="inline"
                onsubmit="return confirm('Delete this certification?')">
            @csrf @method('DELETE')
            <button class="ml-3 text-red-600">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </x-card>

<div class="mt-4">{{ $certs->links() }}</div>
@endsection
