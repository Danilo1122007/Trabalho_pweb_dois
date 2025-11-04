<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lodging extends Model
{
    use HasFactory;

    protected $table = "lodging";

    protected $fillable = [
        'nome',
        'nome_animal',
        'dia_entrada',
        'dia_saida'
    ];
}
