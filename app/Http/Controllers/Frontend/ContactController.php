<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaModel;
use App\Models\AddressModel;
use App\Models\ContactModel;
use Validator;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'social' => SocialMediaModel::all(),
            'address' => AddressModel::first(),
        ];
        return view('frontend.contact.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'telp' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ]);
        }

        $contact = new ContactModel();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->telp = $request->telp;
        $contact->subject = $request->subject;
        $contact->description = $request->description;

        $contact->save();

        return response()->json([
            'message' => 'Pesan berhasil dikirim',
        ]);
    }
}
