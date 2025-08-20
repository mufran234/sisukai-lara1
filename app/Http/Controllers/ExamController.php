<?php

namespace App\Http\Controllers;

use App\Models\{Certification, Question, ExamAttempt, Answer};
use Illuminate\Http\Request;

class ExamController extends Controller
{
  public function start(Certification $certification, string $type, Request $request)
  {
    $count = $type==='diagnostic' ? 30 : ($type==='full' ? 180 : (int)$request->input('count',20));
    // pick questions across topics for this certification
    $questionIds = Question::whereIn('topic_id', $certification->topics()->pluck('id'))
                    ->inRandomOrder()->limit($count)->pluck('id');

    $attempt = ExamAttempt::create([
      'user_id'=>auth()->id(),
      'certification_id'=>$certification->id,
      'attempt_type'=>$type,
      'started_at'=>now(),
      'duration_seconds'=> $type==='full' ? $certification->duration*60 : ($type==='diagnostic' ? 45*60 : 30*60),
    ]);

    session([
      "exam.$attempt->id.questions"=>$questionIds->toArray(),
      "exam.$attempt->id.ends_at"=>now()->addSeconds($attempt->duration_seconds)->toIso8601String()
    ]);

    return redirect()->route('exam.take',$attempt);
  }

  public function take(ExamAttempt $attempt)
  {
    abort_if($attempt->user_id !== auth()->id(), 403);
    $ids = session("exam.$attempt->id.questions", []);
    $questions = \App\Models\Question::with('answers')->find($ids);
    $endsAt = session("exam.$attempt->id.ends_at");
    return view('exams.take', compact('attempt','questions','endsAt'));
  }

  public function submit(ExamAttempt $attempt, Request $request)
  {
    abort_if($attempt->user_id !== auth()->id(), 403);
    $payload = $request->input('answers', []);
    $correct=0; $total=count($payload);

    foreach ($payload as $qid=>$aid) {
      $ans = Answer::where('id',$aid)->where('question_id',$qid)->first();
      $ok = $ans ? (bool)$ans->is_correct : false;
      $attempt->answers()->create([
        'question_id'=>$qid, 'answer_id'=>$aid, 'is_correct'=>$ok
      ]);
      if ($ok) $correct++;
    }

    $score = $total? round(($correct/$total)*100) : 0;
    $attempt->update(['score'=>$score,'completed_at'=>now()]);
    return redirect()->route('results.show',$attempt);
  }
  
      public function start($slug)
    {
        $cert = Certification::where('slug', $slug)
            ->with('domains.topics.questions')
            ->firstOrFail();

        // Collect all questions for this certification
        $questions = $cert->domains
            ->flatMap(fn($d) => $d->topics->flatMap(fn($t) => $t->questions))
            ->shuffle()
            ->take(10); // limit to 10 for MVP

        return view('exams.start', [
            'cert' => $cert,
            'questions' => $questions,
            'duration' => $cert->duration ?? 30, // fallback 30 min
        ]);
    }
	
}
