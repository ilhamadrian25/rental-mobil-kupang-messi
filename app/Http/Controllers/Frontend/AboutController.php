<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AboutModel;
use App\Models\AddressModel;
use App\Models\ClientModel;
use App\Models\MetaModel;
use App\Models\SettingModel;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'social'        =>      SocialMediaModel::all(),
            'address'       =>      AddressModel::first(),
            'client'        =>      ClientModel::all(),
            'meta'=>    MetaModel::first(),
            'about'         => AboutModel::first(),
            'settings' => SettingModel::first(),
        ];
        return view('frontend.about.index', $data);
    }
}
