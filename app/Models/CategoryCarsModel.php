<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCarsModel extends Model
{
    use HasFactory;

    protected $table = 'category_cars';

    protected $fillable = ['id', 'name', 'slug'];

    public function cars()
    {
        return $this->hasMany(CarsModel::class, 'category_cars_id');
    }
}
