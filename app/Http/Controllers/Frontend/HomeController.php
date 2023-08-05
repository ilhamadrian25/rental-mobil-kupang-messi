<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'social'        =>      SocialMediaModel::all(),
            'address'       =>      AddressModel::first(),
        ];

        return view('frontend.home.index', $data);
    }
}
