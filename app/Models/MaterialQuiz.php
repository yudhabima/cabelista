<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialQuiz extends Model
{
    protected $fillable = [
        'material_id',
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
