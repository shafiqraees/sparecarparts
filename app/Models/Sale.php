<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function spare_part() {
        return $this->belongsTo( SparePart::class);
    }
}
