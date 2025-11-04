<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        'quantity',
        'service_date',
        'service_time',
        'launch_date',
        'update_date',
        'imagem',
    ];
}
