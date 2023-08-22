<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'article';

    protected $fillable = ['id', 'title', 'content', 'image', 'status'];

    protected $foreign = 'category_id';

    public function scopeSearch($query, $keyword = null)
    {
        $query->where('title', 'like', '%' . $keyword . '%');
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
