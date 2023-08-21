<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressModel;
use App\Models\SocialMediaModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;
use App\Models\ArticleModel;

class ArticleController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'article' => ArticleModel::latest()->paginate(12),
            'settings' => SettingModel::first(),
        ];

        return view('frontend.articles.index', $data);
    }

    public function show($slug)
    {
        $article = new ArticleModel();

        $show = $article->where('slug', $slug)->first();

        if (!$show) {
            abort(404);
        }

        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'article' => $show,
            'settings' => SettingModel::first(),
            'articles' => ArticleModel::limit(4)->get(),
            'category' => CategoryModel::withCount('article')
                ->limit(8)
                ->get(),
        ];

        return view('frontend.articles.show', $data);
    }
}
