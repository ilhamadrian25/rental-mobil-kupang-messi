<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressModel;
use App\Models\SocialMediaModel;
use App\Models\SettingModel;
use App\Models\MetaModel;
use App\Models\CarsModel;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'meta' => MetaModel::first(),
            'address' => AddressModel::first(),
            'cars' => CarsModel::latest()->paginate(1),
            'settings' => SettingModel::first(),
        ];

        return view('frontend.cars.index', $data);
    }

    public function show($slug)
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'meta' => MetaModel::first(),
            'address' => AddressModel::first(),
            // 'cars' => CarModel::all(),
        ];

        return view('frontend.cars.show', $data);
    }
}
