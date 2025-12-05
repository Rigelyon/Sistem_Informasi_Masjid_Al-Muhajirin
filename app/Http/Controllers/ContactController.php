<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Kirim ke email yang ada di .env (MAIL_FROM_ADDRESS atau custom)
        // Atau bisa hardcode email admin di sini jika mau spesifik
        // Saat ini kita kirim ke MAIL_FROM_ADDRESS sebagai penerima (admin)
        $adminEmail = config('mail.from.address'); 
        
        if(!$adminEmail) {
             return response()->json(['message' => 'Konfigurasi email admin belum diset.'], 500);
        }

        try {
            Mail::to($adminEmail)->send(new ContactFormMail($data));
            return response()->json(['message' => 'Pesan berhasil dikirim!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengirim pesan: ' . $e->getMessage()], 500);
        }
    }
}
