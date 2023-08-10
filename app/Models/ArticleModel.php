<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'article';

    protected $fillable = ['id', 'title', 'content', 'image'];

    protected $foreign = 'category_id';

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
