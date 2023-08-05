<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;

class SocialMediaController extends Controller
{
    public function update(Request $request)
    {

        $social = new SocialMediaModel();

        $facebook = $social::where('id', 1)->first();
        $youtube = $social::where('id', 2)->first();
        $instagram = $social::where('id', 3)->first();

        $facebook->url = $request->facebook_url;
        $youtube->url = $request->youtube_url;
        $instagram->url = $request->instagram_url;

        $facebook->save();

        return response()->json([
            'message'   =>  'success',
        ], 200);
    }
}
