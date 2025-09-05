<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact.contact');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();
        return view('contact.confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->validated();
        Contact::create($contact);
        return view('contact.thanks');
    }

    public function admin(ContactRequest $request)
    {
        $contacts = Contact::Paginate(7);
    return view('admin', ['contacts' => $contacts]);
    }
}