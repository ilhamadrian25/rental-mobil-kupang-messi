<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarsModel;
use App\Models\CategoryCarsModel;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'cars_count' => CarsModel::all()->count(),
            'category_cars_count' => CategoryCarsModel::all()->count(),
            'article_count' => ArticleModel::all()->count(),
            'article_category_count' => CategoryModel::all()->count(),
            'settings' => SettingModel::first(),
            'page' => 'Dashboard',
        ];

        return view('admin.dashboard.index', $data);
    }
}
