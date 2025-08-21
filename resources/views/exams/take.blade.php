@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">{{ $cert->name }} Practice Exam</h1>

    <!-- Exam Timer -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold">Exam in Progress</h2>
        <div id="timer" class="text-lg font-bold text-red-600"></div>
    </div>

    <!-- Exam Form -->
    <form id="exam-form" method="POST" action="{{ route('exams.submit', $cert->slug) }}">
        @csrf
        <input type="hidden" name="time_taken" id="time_taken" value="0">

        @foreach($questions as $index => $question)
            <div class="mb-6 p-4 border rounded-lg bg-white shadow">
                <p class="font-semibold mb-3">
                    Q{{ $index + 1 }}. {{ $question->question }}
                </p>

                @foreach($question->options as $optionKey => $optionValue)
                    <div class="mb-2">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" 
                                   name="answers[{{ $question->id }}]" 
                                   value="{{ $optionKey }}" 
                                   class="form-radio text-blue-500">
                            <span>{{ $optionValue }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="text-center mt-8">
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow">
                Submit Exam
            </button>
        </div>
    </form>
</div>

<script>
    // Duration dynamically passed from Laravel (in minutes)
    let duration = {{ $cert->duration ?? 30 }} * 60; // fallback 30 mins
    let display = document.getElementById('timer');
    let form = document.getElementById('exam-form');

    function startTimer() {
        let timer = duration, minutes, seconds;
        let interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
                document.getElementById('time_taken').value = Math.round(duration / 60);
                form.submit();
            }
        }, 1000);
    }

    window.onload = startTimer;

    // Save elapsed time if user submits early
    form.addEventListener('submit', function () {
        let timeParts = display.textContent.split(":");
        let remaining = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);
        let elapsed = duration - remaining;
        document.getElementById('time_taken').value = Math.round(elapsed / 60);
    });
</script>
@endsection
