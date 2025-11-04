<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $table = 'parking';

    protected $fillable = [
        'modelo',
        'motorista',
        'imagem',
        'hora_entrada',
        'hora_saida',
        'vehicle_type_id', 
        'weight_class_id',
    ];

    public function vehicleType()
    {
        // relacionamento correto com a tabela vehicle_types
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function weightClass() {
        return $this->belongsTo(WeightClass::class, 'weight_class_id');
}
}
