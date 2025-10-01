<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grooming extends Model
{
    use HasFactory;

    protected $table = "grooming";

    protected $fillable = [
        'nome_animal',
        'raca',
        'horario_atendimento',
        'telefone_tutor'
    ];
}
