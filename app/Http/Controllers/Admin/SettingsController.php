<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'social'    =>      SocialMediaModel::all(),
        ];

        return view('admin/settings.index', $data);
    }
}
