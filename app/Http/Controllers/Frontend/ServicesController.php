<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\AddressModel;
use App\Models\SocialMediaModel;

class ServicesController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
        ];

        return view('frontend.services.index', $data);
    }
}
