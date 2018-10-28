<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    protected $table = 'quiz_history';

    protected $fillable = [
        'user', 'session', 'activity', 'answer'
    ];

    public function activity()
    {
        return $this->belongsTo('App\Models\Activity', 'activity','id');
    }
}
