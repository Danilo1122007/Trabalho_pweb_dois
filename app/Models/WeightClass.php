<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightClass extends Model {
    use HasFactory;
    protected $table = 'weight_classes';
    protected $fillable = ['nome','descricao'];
    public function parking() {
        return $this->hasMany(Parking::class, 'weight_class_id');
    }
}
