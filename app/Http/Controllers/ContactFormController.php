<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use App\Models\ContactForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactFormController extends Controller
{
    public function send(ContactFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContactForm::create(attributes: $validated);

        Mail::to($validated["email"])->queue(new ContactFormMail(contact: $validated));

        return back()->with('message', 'Your message has been sent. Thank you!');
    }

    public function messages()
    {
        $messages = ContactForm::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Dashboard/Contacts', [
            'messages' => $messages,
        ]);
    }
}
