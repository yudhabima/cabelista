<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulationResult extends Model
{
    protected $fillable = [
    'name',
    'absen',
    'score',
    'status_t568a',
    'status_t568b',
    'time_used',
    'cable_used',
    'rj45_used',
];

}
