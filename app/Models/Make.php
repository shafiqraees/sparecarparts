<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Make extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function spareParts()
    {
        return $this->hasManyThrough(SparePart::class, Car::class);
    }

    public function scopeSearch($query, $keywords)
    {
        return $query
            ->where('name', 'like', "%" . $keywords . "%");
    }
}
