<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerModel;
use App\Models\SettingModel;
use Validator;

class BannerController extends Controller
{
    public function index()
    {
        $data = [
            'banner' => BannerModel::all(),
            'settings' => SettingModel::first(),
            'page' => 'Banner',
        ];

        return view('admin.banner.index', $data);
    }

    public function store(request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'image' => 'required|image|mimes:jpeg,png,gif',
            ],
            [
                'image.required' => 'Foto tidak boleh kosong!',
                'image.image' => 'Foto tidak valid!',
                'image.mimes' => 'Foto tidak valid!',
            ],
        );

        if ($validate->fails()) {
            return response()->json(
                [
                    'message' => $validate->errors(),
                ],
                400,
            );
        }

        $banner = new BannerModel();

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $banner->image = $imageName;

        if ($banner->save()) {
            return response()->json(
                [
                    'message' => 'Banner berhasil di tambahkan',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Banner gagal ditambakah',
            ],
            400,
        );
    }

    public function destroy(Request $request)
    {
        $banner = BannerModel::where('id', $request->id)->first();

        if ($banner->delete()) {
            return response()->json(
                [
                    'message' => 'Banner berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Banner gagal dihapus',
            ],
            400,
        );

        return response()->json(
            [
                'message' => 'Tidak valid!',
            ],
            400,
        );
    }
}
