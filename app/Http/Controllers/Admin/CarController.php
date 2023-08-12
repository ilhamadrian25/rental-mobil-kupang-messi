<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryCarsModel;
use Illuminate\Http\Request;
use App\Models\CarsModel;
use Validator;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'car'       =>      CarsModel::with('category')->get()
        ];

        return view('admin.cars.index', $data);
    }

    public function create()
    {
        $data = [
            'category'  => CategoryCarsModel::all()
        ];

        return view('admin.cars.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' =>'required|max:100',
            'category_id' =>'required|numeric',
            'price' =>'required|numeric',
            'image' =>'required|mimes:jpg,bmp,png',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message'   =>  $validate->errors(),
            ], 400);
        }

        
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $car = new CarsModel();
        $car->name = $request->name;
        $car->price = $request->price;
        $car->category_cars_id = $request->category_id;
        $car->image = $imageName;
        $car->save();

        return response()->json([
            'message'   =>  'Data berhasil di simpan',
            'redirect'  =>  route('admin.cars')
        ],200);
    }
}
