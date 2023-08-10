<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = ['name', 'slug', 'image'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category_cars()
    {
        return $this->belongsTo(CategoryCarsModel::class, 'id');
    }
}
