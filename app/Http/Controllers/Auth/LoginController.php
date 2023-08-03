<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
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
}
