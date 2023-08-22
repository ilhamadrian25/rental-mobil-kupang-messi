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

    public function scopeSearch($query, $keyword = null)
    {
        $query->where('name', 'like', '%' . $keyword . '%');
    }

    public function category()
    {
        return $this->belongsTo(CategoryCarsModel::class, 'category_cars_id');
    }
}
