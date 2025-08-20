<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
  protected $fillable = ['domain_id','name'];
  public function domain(){ return $this->belongsTo(Domain::class); }
  public function questions(){ return $this->hasMany(Question::class); }
}