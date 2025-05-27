<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ContactForm;



class ContactFormController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
        ]);

        ContactForm::create($data);

        return back()->with('message', 'Your message has been sent. Thank you!');
    }

    public function messages()
    {
        return ContactForm::orderBy('created_at', 'desc')->paginate(10);
    }
}
