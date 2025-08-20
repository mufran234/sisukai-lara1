<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model {
  protected $fillable = ['user_id','certification_id','attempt_type','score','started_at','completed_at','duration_seconds'];
  protected $dates = ['started_at','completed_at'];
  public function certification(){ return $this->belongsTo(Certification::class); }
  public function answers(){ return $this->hasMany(ExamAnswer::class); }
}
