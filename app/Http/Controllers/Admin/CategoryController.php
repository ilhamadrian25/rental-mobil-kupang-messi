<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Models\SettingModel;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'category' => CategoryModel::withCount('article')->get(),
            'settings' => SettingModel::first(),
            'page' => 'Semua kategori artikel',
        ];

        return view('admin.category.index', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'nullable|unique:category',
        ]);

        if ($validate->fails()) {
            return response()->json(
                [
                    'message' => $validate->errors(),
                ],
                401,
            );
        }

        $category = new CategoryModel();

        $category->name = $request->name;

        if (!$request->slug) {
            $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->name), '-'));
        } else {
            $category->slug = $request->slug;
        }

        $checkSlug = CategoryModel::where('slug', $category->slug)->first();

        if ($checkSlug !== null) {
            return response()->json(
                [
                    'message' => 'Slug telah digunakan',
                ],
                400,
            );
        }

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
        $category = CategoryModel::where('id', $request->id)->first();

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
                    'message' => 'Kategori berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Kategori gagal dihapus',
            ],
            400,
        );
    }
}
