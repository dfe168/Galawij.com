<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;



class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'message' => ['required', 'string'],
        ]);

        Mail::to('dkaban@gmail.com')->send(new ContactMail($data));

        return back()->with('message', 'Your message has been sent. Thank you!');
    }
}
