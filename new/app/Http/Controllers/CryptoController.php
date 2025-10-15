<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoController extends Controller
{
    /**
     * Show the decrypt tool page (for teams).
     */
    public function showDecrypt()
    {
        return view('crypto.decrypt');
    }

    /**
     * Process decryption request.
     */
    public function decrypt(Request $request)
    {
        $request->validate([
            'encrypted' => 'required|string',
            'key' => 'required|string',
        ]);

        try {
            $encrypted = $request->input('encrypted');
            $key = $request->input('key');
            
            // Decode base64
            $data = base64_decode($encrypted);
            
            // Extract IV (first 16 bytes for AES)
            $iv = substr($data, 0, 16);
            $ciphertext = substr($data, 16);
            
            // Hash key to get 32 bytes for AES-256
            $keyHash = hash('sha256', $key, true);
            
            // Decrypt
            $decrypted = openssl_decrypt(
                $ciphertext,
                'AES-256-CBC',
                $keyHash,
                OPENSSL_RAW_DATA,
                $iv
            );
            
            if ($decrypted === false) {
                return back()->with('error', 'Decryption gagal. Pastikan encrypted text dan key benar.');
            }
            
            return back()->with([
                'success' => 'Decryption berhasil!',
                'decrypted' => $decrypted,
            ]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the encrypt tool page (for operators).
     */
    public function showEncrypt()
    {
        return view('crypto.encrypt');
    }

    /**
     * Process encryption request.
     */
    public function encrypt(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'key' => 'required|string',
        ]);

        try {
            $text = $request->input('text');
            $key = $request->input('key');
            
            // Generate random IV (16 bytes for AES)
            $iv = openssl_random_pseudo_bytes(16);
            
            // Hash key to get 32 bytes for AES-256
            $keyHash = hash('sha256', $key, true);
            
            // Encrypt
            $encrypted = openssl_encrypt(
                $text,
                'AES-256-CBC',
                $keyHash,
                OPENSSL_RAW_DATA,
                $iv
            );
            
            // Combine IV and ciphertext, then base64 encode
            $result = base64_encode($iv . $encrypted);
            
            return back()->with([
                'success' => 'Encryption berhasil!',
                'encrypted' => $result,
            ]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
