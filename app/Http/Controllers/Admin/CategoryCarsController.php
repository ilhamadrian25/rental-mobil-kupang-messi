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
            'category'  => CategoryCarsModel::withCount('cars')->get()
        ];

        return view('admin.category_cars.index', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' =>'required|max:30',
            'slug' =>'nullable|max:30|unique:category_cars',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message'   =>  $validate->errors()
            ], 400);
        }

        $category = new CategoryCarsModel();

        $category->name = $request->name;

        if (!$request->slug) {
            $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->name), '-'));
        }else {
            $category->slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9-]+/', '-', $request->slug), '-'));
        }
        
        $category->save();

        return response()->json([
          'message'   =>  'Berhasil menambah data'
        ], 200);
    }
}
