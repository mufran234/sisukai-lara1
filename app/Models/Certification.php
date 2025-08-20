<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model {
  protected $fillable = ['name','slug','description','duration','is_active','logo_path'];
  public function domains(){ return $this->hasMany(Domain::class); }
  public function topics(){ return $this->hasManyThrough(Topic::class, Domain::class); }
  public function questions(){ return $this->hasManyThrough(Question::class, Topic::class, 'domain_id', 'topic_id'); }
}
