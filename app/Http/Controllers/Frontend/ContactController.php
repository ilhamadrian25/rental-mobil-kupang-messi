<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'social'        =>      SocialMediaModel::all(),
        ];
        return view('frontend.contact.index', $data);
    }

    public function store(Request $request)
    {
        return response()->json([
            "message"   =>  'heho'
        ]);
    }
}
