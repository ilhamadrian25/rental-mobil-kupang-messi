<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'category' => CategoryModel::all(),
        ];

        return view('admin.category.index', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'slug' => 'nullable|max:50|unique:category',
        ]);

        if ($validate->fails()) {
            return response()->json(
                [
                    'message' => $validate->errors(),
                ],
                401,
            );
        }

        $category = new CategoryCarsModel();

        $category->name = $request->name;
        $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->slug), '-'));

        $category->save();

        if ($category->save()) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data berhasil ditambahkan',
                ],
                200,
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Data gagal ditambahkan',
            ],
            400,
        );
    }

    public function destroy(Request $request)
    {
        $category = CategoryCarsModel::where('id', $request->id)->first();

        $article = ArticleModel::where('category_id', $request->id)->first();

        if ($article) {
            return response()->json(
                [
                    'message' => 'Kategori memiliki Artikel',
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
