<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'session_id',
        'quantity',
    ];

    // 🔽 Adiciona o relacionamento com Product
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
