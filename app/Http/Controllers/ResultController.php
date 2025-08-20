<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;

class ResultController extends Controller
{
  public function show(ExamAttempt $attempt)
  {
    abort_if($attempt->user_id !== auth()->id(), 403);
    $answers = $attempt->answers()->with('question.topic.domain')->get();

    // domain stats
    $domainStats = [];
    foreach ($answers as $a) {
      $d = $a->question->topic->domain;
      $key = $d->id;
      $domainStats[$key] = $domainStats[$key] ?? ['name'=>$d->name,'correct'=>0,'total'=>0,'weight'=>$d->weight];
      $domainStats[$key]['total']++;
      if ($a->is_correct) $domainStats[$key]['correct']++;
    }
    foreach ($domainStats as &$d) {
      $d['score'] = $d['total'] ? round($d['correct']/$d['total']*100) : 0;
    }

    // weakest 3 topics
    $topicStats = [];
    foreach ($answers as $a) {
      $t = $a->question->topic;
      $topicStats[$t->id] = $topicStats[$t->id] ?? ['name'=>$t->name,'correct'=>0,'total'=>0];
      $topicStats[$t->id]['total']++;
      if ($a->is_correct) $topicStats[$t->id]['correct']++;
    }
    $weakest = collect($topicStats)->map(function($v){
      $v['score']=$v['total']? round($v['correct']/$v['total']*100):0; return $v;
    })->sortBy('score')->take(3);

    return view('exams.result', compact('attempt','domainStats','weakest'));
  }
}
