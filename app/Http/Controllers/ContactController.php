<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Send email to the configured address
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormMail($validated));

            Log::info('Mensagem de contacto enviada com sucesso', [
                'email' => $validated['email'],
                'subject' => $validated['subject']
            ]);

            return back()->with('success', 'Mensagem enviada com sucesso! Entraremos em contacto consigo brevemente.');
        } catch (\Exception $e) {
            Log::error('Erro ao enviar mensagem de contacto', [
                'error' => $e->getMessage(),
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente mais tarde.');
        }
    }
}