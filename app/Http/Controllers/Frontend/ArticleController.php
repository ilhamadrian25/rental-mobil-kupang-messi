<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressModel;
use App\Models\SocialMediaModel;
use App\Models\CategoryModel;

class ArticleController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
        ];
        return view('frontend.articles.index', $data);
    }

    public function show()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'category' => CategoryModel::withCount('article')
                ->limit(8)
                ->get(),
        ];
        return view('frontend.articles.show', $data);
    }
}
