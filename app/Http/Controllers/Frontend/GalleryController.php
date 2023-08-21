<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->params('type');

        if ($type === 'photo') {
            return view('frontend.photo.index');
        }elseif ($type === 'video') {
            return view('frontend.video.index');
        }

        abort(404);
    }
}
