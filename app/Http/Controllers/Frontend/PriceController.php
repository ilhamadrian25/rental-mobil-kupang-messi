<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;
use App\Models\MetaModel;
use App\Models\SettingModel;

class PriceController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'settings' => SettingModel::first(),
            'meta' => MetaModel::first(),
        ];

        return view('frontend.price.index', $data);
    }
}
