<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryCarsModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\CarsModel;
use Validator;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'car' => CarsModel::with('category')->get(),
            'settings' => SettingModel::first(),
            'page' => 'Semua Mobil',
        ];

        return view('admin.cars.index', $data);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $car = CarsModel::where('id', $id)->first();

        if ($car) {
            $car->delete();
            return response()->json(
                [
                    'message' => 'Data mobil berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Data mobil gagal dihapus',
            ],
            400,
        );
    }

    public function create()
    {
        $data = [
            'category' => CategoryCarsModel::all(),
            'settings' => SettingModel::first(),
            'page' => 'Tambah data mobil',
        ];

        return view('admin.cars.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:100',
                'category_id' => 'required|numeric',
                'price' => 'required|numeric',
                'image' => 'required|mimes:jpg,bmp,png',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 100 Karakter',
                'category_id.required' => 'Kategori tidak boleh kosong',
                'category_id.numeric' => 'Kategori tidak valid',
                'image.required' => 'Gambar tidak boleh kosong',
                'imgae.mimes' => 'Gambar tidak valid',
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

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $fiturArray = [];

        foreach ($request->fitur as $key => $fitur) {
            foreach ($fitur as $index => $item) {
                $fiturArray[$index][$key] = $item;
            }
        }

        $fiturJson = json_encode($fiturArray);

        $car = new CarsModel();
        $car->name = $request->name;
        $car->price = $request->price;
        $car->category_cars_id = $request->category_id;
        $car->features = $fiturJson;
        $car->image = $imageName;
        $car->save();

        return response()->json(
            [
                'message' => 'Data berhasil di simpan',
                'redirect' => route('admin.cars'),
            ],
            200,
        );
    }

    public function edit($id)
    {
        $car = CarsModel::with('category')
            ->where('id', $id)
            ->first();

        if (!$car) {
            abort(404);
        }

        $data = [
            'category' => CategoryCarsModel::all(),
            'settings' => SettingModel::first(),
            'page' => 'Edit ' . $car->name,
            'car' => $car,
        ];

        return view('admin.cars.edit', $data);
    }

    public function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:100',
                'category_id' => 'required',
                'price' => 'required',
                'image' => 'mimes:jpg,bmp,png',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama terlalu panjang',
                'category_id.required' => 'Tidak boleh diubah script htmlnya',
                'price.required' => 'Harga tidak boleh kosong',
                'image.mimes' => 'Gambar tidak valid',
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

        $featuresArray = [];

        foreach ($request->fitur as $key => $fitur) {
            foreach ($fitur as $index => $item) {
                $featuresArray[$index][$key] = $item;
            }
        }

        $featuresJson = json_encode($featuresArray);

        $car = [
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'category_cars_id' => $request->category_id,
            'features' => $featuresJson,
        ];

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $car['image'] = $imageName;
        }

        if (CarsModel::where('id', $request->id)->update($car)) {
            return response()->json(
                [
                    'message' => 'Data berhasil diupdate',
                ],
                200,
            );
        }
        return response()->json(
            [
                'message' => 'Data gagal diupdate',
            ],
            400,
        );
    }
}
