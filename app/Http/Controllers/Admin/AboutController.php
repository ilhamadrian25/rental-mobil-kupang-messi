<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutModel;
use App\Models\SettingModel;
use Validator;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => SettingModel::first(),
            'about' => AboutModel::first(),
            'page' => 'Pengaturan halaman tentang',
        ];

        return view('admin.about.index', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'image|mimes:jpg,png,gif',
                'image2' => 'image|mimes:jpg,png,gif',
                'description' => 'required',
            ],
            [
                'image.image' => 'Gambar 1 tidak valid!',
                'image.mimes' => 'Gambar 1 harus memiliki format JPG, PNG, atau GIF',

                'image2.image' => 'Gambar 2 tidak valid!',
                'image2.mimes' => 'Gambar 2 harus memiliki format JPG, PNG, atau GIF',

                'description.required' => 'Deskripsi tidak boleh kosong',
            ],
        );

        // dd($request->all());

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors(),
                ],
                400,
            );
        }

        $about = AboutModel::first();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imageName);

            $about->image = $imageName;
        }

        if ($request->hasFile('image2')) {
            $imageName2 = time() . '.' . $request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move(public_path('images'), $imageName2);

            $about->image2 = $imageName2;
        }

        $about->description = $request->description;

        if ($about->save()) {
            return response()->json(
                [
                    'message' => 'Halaman tentang berhasil diperbaharui',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Terjadi kesalahan ketika memperbaharui',
            ],
            400,
        );
    }
}
