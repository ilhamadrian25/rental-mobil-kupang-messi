<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientModel;
use Validator;

class ClientController extends Controller
{
    public function index()
    {
        $data = [
            'client' => ClientModel::orderByDesc('id')->get(),
        ];

        return view('admin.client.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:50',
                'image' => 'required',
                'message' => 'required|max:500',
                'position' => 'max:50',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh melebihi 50 karakter',
                'image.required' => 'Gambar tidak boleh kosong',
                'message.required' => 'Pesan tidak boleh kosong',
                'message.max' => 'Pesan tidak boleh melebihi 500 karakter',
                'position.max' => 'Pelanggan tidak boleh melebihi 50 karakter',
            ],
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors(),
                ],
                400,
            );
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $client = new ClientModel();

        $client->name = $request->name;
        $client->image = $imageName;
        $client->message = $request->message;
        $client->position = $request->position;

        if ($client->save()) {
            return response()->json(
                [
                    'message' => 'Data berhasil ditambahkan',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Data gagal ditambahkan',
            ],
            400,
        );
    }

    public function destroy(Request $request)
    {
        $client = ClientModel::find($request->id);

        if ($client->delete()) {
            return response()->json(
                [
                    'message' => 'Data berhasil dihapus',
                ],
                200,
            );
        }

        return response()->json(
            [
                'message' => 'Data gagal dihapus',
            ],
            400,
        );
    }
}
