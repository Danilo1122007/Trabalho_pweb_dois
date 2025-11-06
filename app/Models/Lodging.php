<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lodging extends Model
{
    use HasFactory;

    protected $table = "lodging";

    protected $fillable = [
        'animal_id',
        'dia_entrada',
        'dia_saida'
    ];

    public function animal()
    {
        return $this->belongsTo(Animals::class, 'animal_id');
    }
}