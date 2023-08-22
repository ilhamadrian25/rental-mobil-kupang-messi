<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => SettingModel::first(),
            'page' => 'Profil',
        ];
        return view('admin.profile.index', $data);
    }

    public function update(Request $request)
    {
        $type = $request->type;

        if ($type === '1') {
            $user = Auth::user();

            $validate = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email',
                ],
                [
                    'name.required' => 'Nama tidak boleh kosong!',
                    'name.string' => 'Nama harus string!',
                    'name.max' => 'Nama terlalu panjang!',

                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Email tidak valid!',
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

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            $user->refresh();

            return response()->json(['message' => 'Informasi akun berhasil diperbaharui.'], 200);
        } elseif ($type === '2') {
            $user = Auth::user();

            $validate = Validator::make(
                $request->all(),
                [
                    'lastpassword' => 'required',
                    'password' => 'required|min:5|',
                ],
                [
                    'lastpassword.required' => 'Password lama tidak boleh kosong',

                    'password.required' => 'Passsword tidak boleh kosong!',
                    'password.min' => 'Passsword terlalu pendek!',
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

            if (!Hash::check($request->input('lastpassword'), $user->password)) {
                return response()->json(['message' => 'Password lama tidak sama'], 422);
            }

            if ($request->input('password') !== $request->input('confPassword')) {
                return response()->json(['message' => 'Konfirmasi password tidak sama'], 422);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            $user->refresh();

            Auth::guard('web')->logout();

            return response()->json(['message' => 'Password berhasil di perbaharui'], 200);
        }
    }
}
