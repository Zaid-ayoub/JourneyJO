<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct()
    {
        // Get the latest 3 messages
        $messages = ContactUs::with('user')->latest()->limit(3)->get();
        $messageCount = $messages->count();

        // Share the messages and message count globally
        view()->share('latestMessages', $messages);
        view()->share('messageCount', $messageCount);
    }

    /**
     * List all contact messages (accessible only to super_admins).
     */
    public function index()
    {
        if (auth()->user()->role_id !== 3) {
            abort(403, 'Unauthorized action.'); // Restrict access to super_admins only
        }

        // Eager load the 'user' relationship
        $messages = ContactUs::with('user')->latest()->get();

        return view('contact_us', compact('messages'));
    }

    /**
     * Show a specific contact message.
     */
    public function show($id)
    {
        if (auth()->user()->role_id !== 3) {
            abort(403, 'Unauthorized action.'); // Restrict access to super_admins only
        }

        $message = ContactUs::with('user')->findOrFail($id);

        return view('contact_us.show', compact('message'));
    }
}