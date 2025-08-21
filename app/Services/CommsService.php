<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommsService;

class PagesController extends Controller
{
    public function pricing() { return view('pages.pricing'); }
    public function faq() { return view('pages.faq'); }
    public function blog() { return view('pages.blog'); }
    public function contact() { return view('pages.contact'); }

    public function submitContact(Request $request, CommsService $comms)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        // Placeholder email (logs for now)
        $comms->sendEmail(config('mail.from.address'), 'Contact form message', json_encode($data));

        return back()->with('status', 'Thanks! We received your message and will get back to you.');
    }
}

