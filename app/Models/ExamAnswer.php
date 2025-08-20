<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model {
  protected $fillable = ['exam_attempt_id','question_id','answer_id','is_correct'];
  public function attempt(){ return $this->belongsTo(ExamAttempt::class, 'exam_attempt_id'); }
  public function question(){ return $this->belongsTo(Question::class); }
  public function answer(){ return $this->belongsTo(Answer::class); }
}
