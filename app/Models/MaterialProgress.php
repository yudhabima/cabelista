<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MaterialProgress extends Model
{
    protected $fillable = ['user_id', 'material_id', 'current_step', 'is_completed'];
}