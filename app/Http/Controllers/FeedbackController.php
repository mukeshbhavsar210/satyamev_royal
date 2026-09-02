<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller {
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string|max:5000',
        ]);

        $toEmail = setting('email');

        if (!$toEmail) {
            return back()->with('error', 'Feedback email address is not configured.');
        }

        Mail::send('emails.feedback', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? '',
            'feedbackMessage' => $validated['message'],
        ], function ($mail) use ($toEmail) {
            $mail->to($toEmail)
                ->subject('New Feedback Form Submission');
        });

        // Mail::send('emails.feedback', $validated, function ($mail) use ($toEmail) {
        //     $mail->to($toEmail)
        //          ->subject('New Feedback Form Submission');
        // });

        return back()->with('success', 'Thank you! Your feedback has been submitted.');
    }
}
