<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCarsModel;
use App\Models\CarsModel;
use App\Models\SettingModel;
use Validator;

class CategoryCarsController extends Controller
{
    public function index()
    {
        $data = [
            'category' => CategoryCarsModel::withCount('cars')->get(),
            'settings' => SettingModel::first(),
            'page' => 'Semua kategori mobil',
        ];

        return view('admin.category_cars.index', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'slug' => 'nullable|unique:category_cars',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'slug.unique' => 'Slug telah digunakan',
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
        $category = new CategoryCarsModel();
        $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->slug ?: $request->name), '-'));

        if (CategoryCarsModel::where('slug', $category->slug)->count() > 0) {
            return response()->json(
                [
                    'message' => 'Slug telah digunakan, ganti dengan yang lain',
                ],
                500,
            );
        }

        $category->name = $request->name;

        $category->save();

        return response()->json(
            [
                'message' => 'Berhasil menambah data',
            ],
            200,
        );
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $category = CategoryCarsModel::where('id', $id)->first();

        if (!$category) {
            return response()->json(
                [
                    'message' => 'Data tidak ditemukan',
                ],
                404,
            );
        }

        if (CarsModel::where('category_cars_id', $category->id)->first()) {
            return response()->json(
                [
                    'message' => 'Kategori masih memiliki mobil',
                ],
                400,
            );
        }

        if ($category->delete()) {
            return response()->json(
                [
                    'message' => 'Data berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Data gagal dihapus',
            ],
            400,
        );
    }
}
