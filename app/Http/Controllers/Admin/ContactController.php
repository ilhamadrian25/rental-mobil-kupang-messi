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
}
