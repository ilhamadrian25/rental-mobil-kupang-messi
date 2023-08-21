<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;
use App\Models\ArticleModel;
use App\Models\CarsModel;
use App\Models\AboutModel;
use App\Models\SettingModel;
use App\Models\BannerModel;
use App\Models\ClientModel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'banners' => DB::table('banner')->get(),
            'cars' => CarsModel::limit(3)
                ->latest()
                ->get(),
            'clients' => ClientModel::all(),
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'about' => AboutModel::first(),
            'banner' => BannerModel::first(),
            'article' => ArticleModel::limit(3)->get(),
            'settings' => SettingModel::first(),
        ];

        return view('frontend.home.index', $data);
    }
}
