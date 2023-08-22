<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\AddressModel;
use App\Models\MetaModel;
use App\Models\GalleryModel;
use App\Models\SocialMediaModel;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'photo') {
        } elseif ($type === 'video') {
            return view('frontend.video.index');
        }

        abort(404);
    }

    public function photo(Request $request)
    {
        $data = [
            'address' => AddressModel::first(),
            'settings' => SettingModel::first(),
            'social' => SocialMediaModel::all(),
            'meta' => MetaModel::first(),
            'photo' => GalleryModel::where('type', 'image')
                ->latest()
                ->paginate(12),
        ];
        return view('frontend.photo.index', $data);
    }

    public function video()
    {
        $data = [
            'address' => AddressModel::first(),
            'settings' => SettingModel::first(),
            'social' => SocialMediaModel::all(),
            'meta' => MetaModel::first(),
            'video' => GalleryModel::where('type', 'video')
                ->latest()
                ->paginate(12),
        ];
        return view('frontend.video.index', $data);
    }
}
