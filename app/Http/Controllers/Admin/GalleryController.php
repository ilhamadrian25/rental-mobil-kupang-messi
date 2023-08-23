<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryModel;
use App\Models\SettingModel;
use Validator;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        if ($type === 'image') {
            $data = [
                'image' => GalleryModel::where('type', 'image')->latest(),
                'settings' => SettingModel::first(),
                'page' => 'Semua Foto',
            ];

            return view('admin.image.index', $data);
        } elseif ($type === 'video') {
            $data = [
                'video' => GalleryModel::where('type', 'video')->latest(),
                'settings' => SettingModel::first(),
                'page' => 'Semua Video',
            ];

            return view('admin.video.index', $data);
        }
        abort(404);
    }

    public function store(Request $request)
    {
        $type = $request->type;

        if ($type === 'image') {
            $validate = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,gif',
                    'type' => 'required|in:image',
                ],
                [
                    'image.required' => 'Foto tidak boleh kosong!',
                    'image.image' => 'Foto tidak valid!',
                    'image.mimes' => 'Foto tidak valid!',
                    'type.required' => 'Type foto tidak boleh kosong!',
                    'type.in' => 'Jangan ubah value type!',
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

            $video = new GalleryModel();

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $video->image = $imageName;
            $video->type = $request->type;

            if ($video->save()) {
                return response()->json(
                    [
                        'message' => 'Foto berhasil di tambahkan',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Foto gagal ditambakah',
                ],
                400,
            );
        } elseif ($type === 'video') {
            $validate = Validator::make(
                $request->all(),
                [
                    'url' => 'required',
                    'type' => 'required|in:video',
                ],
                [
                    'url.required' => 'Url YouTube tidak boleh kosong',
                    'type.required' => 'Type video tidak boleh kosong!',
                    'type.in' => 'Jangan ubah value type!',
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

            $video = new GalleryModel();

            $video->url = $request->url;
            $video->type = $request->type;

            if ($video->save()) {
                return response()->json(
                    [
                        'message' => 'Video berhasil di tambahkan',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Video gagal ditambakah',
                ],
                400,
            );
        }
    }

    public function destroy(Request $request)
    {
        if ($request->type === 'image') {
            $image = GalleryModel::where('id', $request->id)->first();

            if ($image->type !== $request->type) {
                return response()->json([
                    'message' => 'Foto tidak valid',
                ]);
            }

            if ($image->delete()) {
                return response()->json(
                    [
                        'message' => 'Foto berhasil dihapus',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Foto gagal dihapus',
                ],
                400,
            );
        } elseif ($request->type === 'video') {
            $video = GalleryModel::where('id', $request->id)->first();

            if ($video->type !== $request->type) {
                return response()->json([
                    'message' => 'Video tidak valid!',
                ]);
            }

            if ($video->delete()) {
                return response()->json(
                    [
                        'message' => 'Video berhasil dihapus',
                    ],
                    200,
                );
            }

            return response()->json(
                [
                    'message' => 'Video gagal dihapus!s',
                ],
                400,
            );
        }

        return response()->json(
            [
                'message' => 'Tidak valid!',
            ],
            400,
        );
    }
}
