<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialQuiz;


class Material extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'xp_point',
        'total_score',
        'progress_level',
        'xp_reward'
    ];

    public function steps()
{
    return $this->hasMany(MaterialStep::class);
}

public function quizzes()
{
    return $this->hasMany(MaterialQuiz::class);
}

}
