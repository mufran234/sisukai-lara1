@extends('admin.layout')

@section('admin')
<h1 class="text-2xl font-bold mb-4">Edit Certification</h1>
<form method="POST" action="{{ route('admin.certifications.update',$certification) }}" class="bg-white rounded-2xl shadow p-6">
  @csrf @method('PUT')
  @include('admin.partials._field',['label'=>'Name','name'=>'name','value'=>$certification->name])
  @include('admin.partials._field',['label'=>'Slug','name'=>'slug','value'=>$certification->slug])
  @include('admin.partials._field',['label'=>'Duration (minutes)','name'=>'duration','type'=>'number','value'=>$certification->duration])
  @include('admin.partials._field',['label'=>'Active?','name'=>'is_active','type'=>'checkbox','value'=>$certification->is_active])
  @include('admin.partials._field',['label'=>'Description','name'=>'description','type'=>'textarea','value'=>$certification->description])
  <x-button type="submit">Save</x-button>
</form>
@endsection
