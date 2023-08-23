<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\AddressModel;
use App\Models\MetaModel;
use App\Models\BannerModel;
use App\Models\SocialMediaModel;
use Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'settings' => SettingModel::first(),
            'address' => AddressModel::first(),
            'banner' => BannerModel::first(),
            'meta' => MetaModel::first(),
            'page' => 'Pengaturan umum',
        ];

        return view('admin/settings.index', $data);
    }

    public function update(Request $request)
    {
        $type = $request->type;

        if ($type === 'web') {
            $validate = Validator::make(
                $request->all(),
                [
                    'title' => 'required|max:60',
                    'about' => 'required|max:1000',
                ],
                [
                    'title.required' => 'Nama website tidak boleh kosong!',
                    'title.max' => 'Nama website terlalu panjang',

                    'about.required' => 'Footer tentang tidak boleh kosong!',
                    'about.max' => 'Footer tentang terlalu panjang',
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

            $setting = SettingModel::first();

            $setting->title = $request->title;
            $setting->about = $request->about;

            if ($setting->update()) {
                return response()->json(
                    [
                        'message' => 'Pengaturan berhasil diubah',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Gagal mengubah pengaturan',
                ],
                400,
            );
        } elseif ($type === 'contact') {
            $validate = Validator::make(
                $request->all(),
                [
                    'address' => 'required|max:1000',
                    'email' => 'required|email',
                    'telp' => 'required',
                    'whatsapp' => 'required',
                    'maps' => 'required',
                ],
                [
                    'address.required' => 'Alamat website tidak boleh kosong!',
                    'address.max' => 'Alamat website terlalu panjang',

                    'email.required' => 'Alamat Email tidak boleh kosong!',
                    'email.email' => 'Alamat Email tidak valid',

                    'telp.required' => 'Nomor telepon tidak boleh kosong!',

                    'whatsapp.required' => 'Nomor telepon tidak boleh kosong!',

                    'maps.required' => 'Maps tidak boleh kosong!',
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

            $setting = AddressModel::first();

            $setting->address = $request->address;
            $setting->email = $request->email;
            $setting->telp = $request->telp;
            $setting->whatsapp = $request->whatsapp;
            $setting->maps = $request->maps;

            if ($setting->update()) {
                return response()->json(
                    [
                        'message' => 'Pengaturan berhasil diubah',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Gagal mengubah pengaturan',
                ],
                400,
            );
        } elseif ($type === 'sosmed') {
            $facebook = [
                'url' => $request->facebook,
            ];
            $youtube = [
                'url' => $request->youtube,
            ];
            $instagram = [
                'url' => $request->instagram,
            ];

            SocialMediaModel::where('name', 'Facebook')->update($facebook);
            SocialMediaModel::where('name', 'YouTube')->update($youtube);
            SocialMediaModel::where('name', 'Instagram')->update($instagram);

            return response()->json(
                [
                    'message' => 'Sosial Media berhasil di perbaharui!',
                ],
                200,
            );
        } elseif ($type === 'logo') {
            // return response()->json(
            //     [
            //         'message' => 'Oke',
            //     ],
            //     200,
            // );

            $validate = validator::make(
                $request->all(),
                [
                    'logo' => 'image|mimes:png,jpg,jpeg,gif,svg',
                    'favicon' => 'image|mimes:png,ico',
                    'logo_admin' => 'image|mimes:png,jpg,jpeg,gif,svg',
                ],
                [
                    'logo.image' => 'Logo tidak valid!',
                    'logo.mimes' => 'Logo tidak valid!',

                    'favicon.png' => 'favicon tidak valid!',
                    'favicon.mimes' => 'favicon tidak valid!',

                    'logo_admin.image' => 'Logo admin tidak valid!',
                    'logo_admin.mimes' => 'Logo admin tidak valid!',
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

            $setting = SettingModel::first();
            $banner = BannerModel::first();

            if ($request->logo) {
                $imageName = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('logo'), $imageName);

                $setting->logo = $imageName;
            }

            if ($request->favicon) {
                $imageName = time() . '.' . $request->favicon->extension();
                $request->favicon->move(public_path('logo'), $imageName);

                $setting->favicon = $imageName;
            }

            if ($request->logo_admin) {
                $imageName = time() . '.' . $request->logo_admin->extension();
                $request->logo_admin->move(public_path('logo'), $imageName);

                $setting->logo_admin = $imageName;
            }

            if ($request->banner) {
                $imageName = time() . '.' . $request->banner->extension();
                $request->banner->move(public_path('banner'), $imageName);

                $banner->image = $imageName;
            }

            if ($banner->update()) {
                return response()->json(
                    [
                        'message' => 'Banner berhasil diperbaharui',
                    ],
                    200,
                );
            }

            if ($setting->update()) {
                return response()->json(
                    [
                        'message' => 'Logo berhasil diperbaharui',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Tidak dapat memperbaharui Logo!',
                ],
                400,
            );
        } elseif ($type === 'meta') {
            $validate = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'description' => 'required',
                    'keywords' => 'required',
                ],
                [
                    'title.required' => 'Title tidak boleh kosong!',
                    'description.required' => 'Description tidak boleh kosong!',
                    'keywords.required' => 'Keywords tidak boleh kosong!',
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

            $meta = MetaModel::first();

            $meta->title = $request->title;
            $meta->description = $request->description;
            $meta->keywords = $request->keywords;

            if ($meta->update()) {
                return response()->json(
                    [
                        'message' => 'Meta berhasil diperbaharui',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Tidak dapat memperbaharui Banner',
                ],
                400,
            );
        }

        return response()->json(
            [
                'message' => 'Tidak dapat melanjutkan permintaan!',
            ],
            400,
        );
    }
}
