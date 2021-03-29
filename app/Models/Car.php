<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function carModel() {
        return $this->belongsTo(CarModel::class);
    }

    public function Make() {
        return $this->belongsTo(Make::class);
    }
}
