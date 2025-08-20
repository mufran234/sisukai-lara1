@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Practice Exam: {{ $cert->name }}</h1>
    <p class="mb-2">Duration: {{ $duration }} minutes</p>
    <form method="POST" action="#">
        @csrf

        @foreach($questions as $index => $q)
            <div class="mb-6 p-4 border rounded-lg bg-white shadow">
                <p class="font-semibold">{{ $index+1 }}. {{ $q->question_text }}</p>
                @foreach(json_decode($q->options) as $optIndex => $option)
                    <label class="block mt-1">
                        <input type="radio" name="answers[{{ $q->id }}]" value="{{ $optIndex }}">
                        {{ $option }}
                    </label>
                @endforeach
            </div>
        @endforeach

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
            Submit Exam
        </button>
    </form>
</div>
@endsection
