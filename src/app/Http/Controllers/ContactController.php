<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();
        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->validated();
        Contact::create($contact);
        return view('thanks');
    }
}