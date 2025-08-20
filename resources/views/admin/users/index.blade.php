@extends('admin.layout')
@section('admin')
<h1 class="text-2xl font-bold mb-4">Users</h1>
@include('components.flash')

<x-card>
  @include('admin.partials._table', ['headers'=>['Name','Email','Tier','Pro Until','Admin']])
    @foreach($users as $u)
      <tr>
        <td class="px-4 py-3">{{ $u->name }}</td>
        <td class="px-4 py-3">{{ $u->email }}</td>
        <td class="px-4 py-3">{{ $u->tier }}</td>
        <td class="px-4 py-3">{{ $u->pro_until ?? '—' }}</td>
        <td class="px-4 py-3">{{ $u->is_admin ? 'Yes' : 'No' }}</td>
        <td class="px-4 py-3 text-right">
          <a href="{{ route('admin.users.edit',$u) }}" class="text-indigo-600">Edit</a>
        </td>
      </tr>
    @endforeach
  </x-card>

<div class="mt-4">{{ $users->links() }}</div>
@endsection
