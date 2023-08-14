<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;

class ArticleController extends Controller
{
    public function index()
    {
        $data = [
            'article'   =>  ArticleModel::all(),
        ];

        // print_r($data);

        return view('admin.articles.index', $data);
    }

    public function show()
    {
        return view('admin.articles.show');
    }
}
