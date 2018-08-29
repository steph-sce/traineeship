<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendContactMail(Request $request)
    {
//        dd($request);
        Mail::to('toto@test.com')->send(new Contact($request));
        return redirect()->route('contact')->with('message', __('Your mail has been sent'));
    }
}
