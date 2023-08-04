<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'contact'   =>  ContactModel::all()
        ];

        return view('admin.contact.index', $data);
    }

    public function destroy(Request $request)
    {

        $id = $request->id;

        $data = ContactModel::find($id);

        if (!$data) {
            response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();
        
        return response()->json([
          'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
