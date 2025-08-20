<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCertification extends Model {
  protected $fillable = ['user_id','certification_id','status'];
  public function certification(){ return $this->belongsTo(Certification::class); }
  public function user(){ return $this->belongsTo(User::class); }
}
