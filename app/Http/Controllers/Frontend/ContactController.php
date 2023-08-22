<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;
use App\Models\MetaModel;
use App\Models\ContactModel;
use App\Models\SettingModel;
use Validator;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
            'meta' => MetaModel::first(),
            'settings' => SettingModel::first(),
        ];
        return view('frontend.contact.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:50',
                'email' => 'required',
                'telp' => 'required|max:50',
                'subject' => 'required|max:50',
                'description' => 'required|max:2000',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama terlalu panjang',
                'email.required' => 'Email tidak boleh kosong',
                'telp.required' => 'No Telp tidak boleh kosong',
                'telp.max' => 'No Telp terlalu panjang',
                'subject.required' => 'Subjek tidak boleh kosong',
                'subject.max' => 'Subjek terlalu panjang',
                'description.required' => 'Pesan tidak boleh kosong',
                'description.max' => 'Pesan terlalu panjang',
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

        $contact = new ContactModel();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->telp = $request->telp;
        $contact->subject = $request->subject;
        $contact->description = $request->description;

        $contact->save();

        return response()->json(
            [
                'message' => 'Pesan berhasil dikirim',
            ],
            200,
        );
    }
}
