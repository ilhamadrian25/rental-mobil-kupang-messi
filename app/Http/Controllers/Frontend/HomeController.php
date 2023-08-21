<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;
use App\Models\ArticleModel;
use App\Models\CarsModel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'banners' => DB::table('banner')->get(),
            'cars' => CarsModel::limit(3)->latest()->get(),
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'article' => ArticleModel::limit(3)->get(),
        ];

        return view('frontend.home.index', $data);
    }
}
