<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\SettingModel;
use Illuminate\Support\Str;
use Auth;
use Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $data = [
            'article' => ArticleModel::orderByDesc('id')->get(),
            'settings' => SettingModel::first(),
            'page' => 'Semua Artikel',
        ];

        return view('admin.articles.index', $data);
    }

    public function create()
    {
        $data = [
            'category' => CategoryModel::all(),
            'settings' => SettingModel::first(),
            'page' => 'Buat Artikel',
        ];

        return view('admin.articles.create', $data);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $article = ArticleModel::where('id', $id)->first();

        if (!$article) {
            return response()->json(
                [
                    'message' => 'Artikel tidak ditemukan!',
                ],
                404,
            );
        }

        if ($article->delete()) {
            return response()->json(
                [
                    'message' => 'Artikel berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Artikel gagal dihapus',
            ],
            400,
        );
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'slug' => 'nullable|unique:article',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'content' => 'nullable',
            ],
            [
                'title.required' => 'Judul tidak boleh kosong',

                'slug' => 'Slug telah digunakan',

                'category_id.required' => 'Kategori tidak boleh kosong!',

                'image.required' => 'Thumbnail tidak boleh kosong',
                'image.image' => 'Thumbnail tidak valid',
                'image.mimes' => 'Thumbnail tidak valid',
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

        $slug = Str::slug($request->slug);

        if (!$slug) {
            $slug = Str::slug($request->title);
        }

        $article = new ArticleModel();

        $checkSlug = ArticleModel::where('slug', $slug)->first();

        if ($checkSlug) {
            $article->slug = $slug . '-' . rand();
        } else {
            $article->slug = $slug;
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $article->user_id = Auth::id();
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->status = $request->status;
        $article->thumbnail = $imageName;

        if ($article->save()) {
            return response()->json(
                [
                    'message' => 'Artikel berhasil ditambahkan',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Artikel gagak ditambahkan',
            ],
            400,
        );
    }

    public function edit($slug)
    {
        $article = ArticleModel::where('slug', $slug)->first();

        if (!$article) {
            abort(404);
        }

        $data = [
            'article' => $article,
            'settings' => SettingModel::first(),
            'page' => 'Edit - ' . $article->title,
            'category' => CategoryModel::all(),
        ];

        return view('admin.articles.edit', $data);
    }

    public function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:50',
                'slug' => 'nullable|max:50',
                'category_id' => 'required',
                'status' => 'required|in:publish,draft',
                'image' => 'image|mimes:jpeg,png,jpg,gif',
                'content' => 'nullable',
            ],
            [
                'title.required' => 'Judul tidak boleh kosong!',
                'title.max' => 'Judul tidak boleh melebihi 50 karakter!',

                'slug' => 'Slug telah digunakan!',
                'slug.max' => 'Slug tidak boleh melebihi 50 Karakter!',

                'category_id.required' => 'Kategori tidak boleh kosong!',

                'status.required' => 'Status tidak boleh kosong!',
                'status.in' => 'Status tidak valid!',

                'image.image' => 'Thumbnail tidak valid!',
                'image.mimes' => 'Thumbnail tidak valid!',
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

        $slug = Str::slug($request->slug);

        if (!$slug) {
            $slug = Str::slug($request->title);
        }

        $article = ArticleModel::where('id', $request->id)->first();

        $article->slug = $slug;

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->thumbnail = $imageName;
        }

        $article->user_id = Auth::id();
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->status = $request->status;

        if ($article->save()) {
            return response()->json(
                [
                    'message' => 'Artikel berhasil diubah',
                    'redirect' => route('admin.article.edit', $article->slug),
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Artikel gagak diubah',
            ],
            400,
        );
    }
}
