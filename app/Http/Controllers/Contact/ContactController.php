<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Nếu muốn lưu vào MongoDB:
use App\Models\Contact;

class ContactController extends Controller
{
    // GET /contact - hiển thị form
    public function index()
    {
        return view('contact');
    }

    // POST /contact - nhận form
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string|max:5000',
        ]);

        // Nếu muốn lưu DB (MongoDB):
        // Contact::create($data);

        // Hoặc gửi mail tại đây...

        return back()->with('success', 'Your message has been sent!');
    }
}
