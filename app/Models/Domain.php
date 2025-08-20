<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model {
  protected $fillable = ['certification_id','name','weight'];
  public function certification(){ return $this->belongsTo(Certification::class); }
  public function topics(){ return $this->hasMany(Topic::class); }
}
