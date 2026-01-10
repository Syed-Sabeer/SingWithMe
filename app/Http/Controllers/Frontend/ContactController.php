<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index(){
        $contact_details = Contact::first();
        return view("frontend.contact", compact('contact_details'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'firstname' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $contactSubmission = ContactSubmission::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            Log::info('Contact form submitted successfully:', ['id' => $contactSubmission->id]);

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Thank you for your message! We will get back to you soon.',
                'icon' => 'success'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Contact form validation error:', ['errors' => $e->errors()]);
            
            return response()->json([
                'status' => 'error',
                'title' => 'Validation Error!',
                'message' => 'Please check your input and try again.',
                'errors' => $e->errors(),
                'icon' => 'error'
            ], 422);

        } catch (\Exception $e) {
            Log::error('Contact form submission error:', ['message' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'title' => 'Error!',
                'message' => 'Sorry, there was an error sending your message. Please try again.',
                'icon' => 'error'
            ], 500);
        }
    }
}
