<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCarsModel;

class CategoryCarsController extends Controller
{
    public function index()
    {
        $data = [
            'category'  => CategoryCarsModel::withCount('cars')->get()
        ];

        return view('admin.category_cars.index', $data);
    }
}
