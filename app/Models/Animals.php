<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    use HasFactory;

    protected $table = "animals";

    protected $fillable = [
        'nome_animal',
        'raca',
        'peso',
        'telefone_tutor',
        'nome_tutor'
    ];

    public function lodgings()
    {
        return $this->hasMany(Lodging::class, 'animal_id');
    }
}