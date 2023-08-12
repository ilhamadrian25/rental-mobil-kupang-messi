<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCarsModel;
use Validator;

class CategoryCarsController extends Controller
{
    public function index()
    {
        $data = [
            'category' => CategoryCarsModel::withCount('cars')->get(),
        ];

        return view('admin.category_cars.index', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:30',
                'slug' => 'nullable|max:30|unique:category_cars',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 30 karakter',
                'slug.max' => 'Slug tidak boleh lebih dari 30 karakter',
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

        $category->name = $request->name;

        $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->slug ?: $request->name), '-'));

        $category->save();

        return response()->json(
            [
                'message' => 'Berhasil menambah data',
            ],
            200,
        );
    }
}
