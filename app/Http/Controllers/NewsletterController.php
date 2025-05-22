<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewsletterConfirmation;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        try {
            $newsletter = Newsletter::create([
                'email' => $request->email
            ]);

            // Send confirmation email
            Mail::to($request->email)->send(new NewsletterConfirmation($newsletter));

            Log::info('Subscrição na newsletter realizada com sucesso', [
                'email' => $request->email,
                'id' => $newsletter->id
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Subscrição realizada com sucesso! Verifique o seu email para confirmar.',
                    'status' => 'success'
                ]);
            }

            return redirect()->back()->with('success', 'Subscrição realizada com sucesso! Verifique o seu email para confirmar.');
        } catch (\Exception $e) {
            Log::error('Erro na subscrição da newsletter', [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Ocorreu um erro ao processar a sua subscrição. Por favor, tente novamente.',
                    'status' => 'error'
                ], 500);
            }

            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a sua subscrição. Por favor, tente novamente.');
        }
    }

    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        try {
            $subscribers = Newsletter::where('is_active', true)->get();
            $count = 0;

            foreach ($subscribers as $subscriber) {
                Mail::raw($request->content, function($message) use ($request, $subscriber) {
                    $message->to($subscriber->email)
                           ->subject($request->subject);
                });
                $count++;
            }

            Log::info('Newsletter enviada com sucesso', [
                'subscribers_count' => $count,
                'subject' => $request->subject
            ]);

            return redirect()->back()->with('success', 'Newsletter enviada com sucesso para ' . $count . ' subscritores!');
        } catch (\Exception $e) {
            Log::error('Erro ao enviar newsletter', [
                'error' => $e->getMessage(),
                'subject' => $request->subject
            ]);

            return redirect()->back()->with('error', 'Ocorreu um erro ao enviar a newsletter. Por favor, tente novamente.');
        }
    }

    public function showDashboard()
    {
        $subscribers = Newsletter::all();
        return view('admin.newsletter', compact('subscribers'));
    }
}
