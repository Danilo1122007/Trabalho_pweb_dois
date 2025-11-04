<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'vehicle_types';

    protected $fillable = ['nome', 'descricao'];

    public function parkings()
    {
        // relacionamento reverso (1:N)
        return $this->hasMany(Parking::class, 'vehicle_type_id');
    }
}
