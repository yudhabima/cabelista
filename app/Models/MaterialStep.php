<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MaterialStep extends Model
{
    protected $fillable = [
        'material_id',
        'title',
        'content',
        'step_number'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
