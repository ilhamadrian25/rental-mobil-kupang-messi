<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarsModel;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'car'       =>      CarsModel::all()
        ];

        return view('admin.cars.index', $data);
    }
}
