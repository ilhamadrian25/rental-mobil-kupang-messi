<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'social'        =>      SocialMediaModel::all(),
        ];

        return view('frontend.home.index', $data);
    }
}
