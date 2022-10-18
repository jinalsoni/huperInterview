<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::get()->toArray();

        return view('email.index', ['emails' => $emails]);
    }

    public function addEmail()
    {
        return view('email.add');
    }

    public function storeEmail(Request $request)
    {
        $request->validate([
            'recipient' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        if (Email::create($request->all())) {
            return redirect()->route('admin.email.index');
        }
    }

    public function delete(Request $request)
    {
        $email = Email::where('id', $request['id'])->first();

        if ($email->delete()) {
            return response()->json(array('success' => true), 200);
        }
    }
}
