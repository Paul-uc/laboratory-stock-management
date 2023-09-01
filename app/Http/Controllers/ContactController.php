<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    
    public function showContactForm()
    {
        return view('terms-and-conditions.contact');
    }

    public function sendContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        // Send email using the ContactFormMail Mailable
        Mail::to('your-email@example.com')->send(new ContactFormMail($data));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
