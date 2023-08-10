<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleModel;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'slug'];

    public function article()
    {
        return $this->hasMany(ArticleModel::class, 'category_id');
    }
}
