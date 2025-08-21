<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function start($slug)
    {
        $cert = Certification::where('slug', $slug)
            ->with('domains.topics.questions')
            ->firstOrFail();

        // Random 10 Qs for MVP
        $questions = $cert->domains
            ->flatMap(fn($d) => $d->topics->flatMap(fn($t) => $t->questions))
            ->shuffle()
            ->take(10);

        return view('exams.start', [
            'cert' => $cert,
            'questions' => $questions,
            'duration' => $cert->duration ?? 30,
        ]);
    }

public function submit(Request $request, $slug)
{
    $cert = \App\Models\Certification::where('slug', $slug)
        ->with('domains.topics.questions')
        ->firstOrFail();

    $answers = $request->input('answers', []);
    $total = count($answers);
    $correct = 0;

    $topicScores = [];
    foreach ($answers as $qid => $choice) {
        $question = \App\Models\Question::find($qid);
        if (!$question) continue;

        $isCorrect = ((string)$choice === (string)$question->correct_answer);
        if ($isCorrect) {
            $correct++;
        }

        if ($question->topic_id) {
            $topicName = $question->topic->name ?? 'General';
            if (!isset($topicScores[$topicName])) {
                $topicScores[$topicName] = ['total' => 0, 'wrong' => 0];
            }
            $topicScores[$topicName]['total']++;
            if (!$isCorrect) {
                $topicScores[$topicName]['wrong']++;
            }
        }
    }

    $score = $total > 0 ? round(($correct / $total) * 100) : 0;

    // capture time_taken from hidden input
    $timeTaken = $request->input('time_taken', null);

    // Save results
    \App\Models\Result::create([
        'user_id' => auth()->id(),
        'certification_id' => $cert->id,
        'score' => $score,
        'total' => $total,
        'time_taken' => $timeTaken,
        'breakdown' => json_encode($topicScores),
    ]);

    $weakest = collect($topicScores)
        ->map(function ($data, $name) {
            return [
                'name' => $name,
                'wrong' => $data['wrong'],
                'total' => $data['total'],
                'ratio' => $data['wrong'] / max($data['total'], 1),
            ];
        })
        ->sortByDesc('ratio')
        ->take(3);

    return view('exams.result', [
        'cert' => $cert,
        'score' => $score,
        'total' => $total,
        'correct' => $correct,
        'weakest' => $weakest,
        'timeTaken' => $timeTaken,
    ]);
}
}
