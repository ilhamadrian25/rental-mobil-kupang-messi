<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->route('admin.dashboard');
        }

        $data = [
            'page' => 'Login',
            'settings' => SettingModel::first(),
        ];

        return view('auth.login', $data);
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Login berhasil!',
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Email atau Password tidak valid!',
                ],
                401,
            );
        }
    }

    public function destroy()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
