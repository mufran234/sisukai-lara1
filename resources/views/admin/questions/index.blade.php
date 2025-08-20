@extends('admin.layout')
@section('admin')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Questions</h1>
  <a href="{{ route('admin.questions.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Add</a>
</div>

@include('components.flash')

<x-card>
  @include('admin.partials._table', ['headers'=>['Question','Certification','Domain','Topic']])
    @foreach($questions as $q)
      <tr>
        <td class="px-4 py-3 max-w-xl truncate">{{ $q->question_text }}</td>
        <td class="px-4 py-3 text-gray-600">{{ $q->certification->name }}</td>
        <td class="px-4 py-3">{{ $q->domain->name }}</td>
        <td class="px-4 py-3">{{ $q->topic->name }}</td>
        <td class="px-4 py-3 text-right">
          <a href="{{ route('admin.questions.edit',$q) }}" class="text-indigo-600">Edit</a>
          <form action="{{ route('admin.questions.destroy',$q) }}" method="POST" class="inline"
                onsubmit="return confirm('Delete question?')">
            @csrf @method('DELETE')
            <button class="ml-3 text-red-600">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </x-card>

<div class="mt-4">{{ $questions->links() }}</div>
@endsection
