@extends('admin.layout')
@section('admin')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>
@include('components.flash')
<form method="POST" action="{{ route('admin.users.update',$user) }}" class="bg-white rounded-2xl shadow p-6">
  @csrf @method('PUT')
  @include('admin.partials._field',['label'=>'Name','name'=>'name','value'=>$user->name])
  @include('admin.partials._field',['label'=>'Email','name'=>'email','value'=>$user->email])

  <label class="block mb-4">
    <span class="text-sm font-medium">Tier</span>
    <select name="tier" class="mt-1 w-full border rounded-lg p-2">
      <option value="free" @selected($user->tier==='free')>Free</option>
      <option value="pro" @selected($user->tier==='pro')>Pro</option>
    </select>
  </label>

  @include('admin.partials._field',[
    'label'=>'Pro Until (YYYY-MM-DD)',
    'name'=>'pro_until',
    'type'=>'date',
    'value'=>optional($user->pro_until)->format('Y-m-d')
  ])

  @include('admin.partials._field',['label'=>'Is Admin?','name'=>'is_admin','type'=>'checkbox','value'=>$user->is_admin])

  <x-button type="submit">Save</x-button>
</form>
@endsection
