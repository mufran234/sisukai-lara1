@extends('admin.layout')
@section('admin')
<h1 class="text-2xl font-bold mb-4">Add Domain</h1>
<form method="POST" action="{{ route('admin.domains.store') }}" class="bg-white rounded-2xl shadow p-6">
  @csrf
  <label class="block mb-4">
    <span class="text-sm font-medium">Certification</span>
    <select name="certification_id" class="mt-1 w-full border rounded-lg p-2">
      @foreach($certs as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </label>
  @include('admin.partials._field',['label'=>'Name','name'=>'name'])
  @include('admin.partials._field',['label'=>'Weight (%)','name'=>'weight','type'=>'number'])
  <x-button type="submit">Create</x-button>
</form>
@endsection
