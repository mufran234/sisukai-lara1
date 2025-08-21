<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id',
        'certification_id',
        'total_questions',
        'correct_answers',
        'score',
        'weakest_topics',
    ];

    protected $casts = [
        'weakest_topics' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }
}
