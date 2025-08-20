@extends('admin.layout')

@section('admin')
<h1 class="text-2xl font-bold mb-4">Add Certification</h1>
<form method="POST" action="{{ route('admin.certifications.store') }}" class="bg-white rounded-2xl shadow p-6">
  @csrf
  @include('admin.partials._field',['label'=>'Name','name'=>'name'])
  @include('admin.partials._field',['label'=>'Slug','name'=>'slug','hint'=>'Leave blank to auto-generate'])
  @include('admin.partials._field',['label'=>'Duration (minutes)','name'=>'duration','type'=>'number'])
  @include('admin.partials._field',['label'=>'Active?','name'=>'is_active','type'=>'checkbox','value'=>true])
  @include('admin.partials._field',['label'=>'Description','name'=>'description','type'=>'textarea'])
  <x-button type="submit">Create</x-button>
</form>
@endsection
