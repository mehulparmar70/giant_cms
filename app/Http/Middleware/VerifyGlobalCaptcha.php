<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyGlobalCaptcha
{
    public function handle(Request $request, Closure $next)
    {
        // Only validate CAPTCHA for POST requests
        if ($request->isMethod('post')) {
            // Check if the CAPTCHA response exists
            $captchaResponse = $request->input('cf-turnstile-response');
            if (!$captchaResponse) {
                return response()->json(['error' => 'CAPTCHA validation is required'], 400);
            }

            // Verify CAPTCHA with Cloudflare
            $result = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => env('TURNSTILE_SITE_SECRET'),
                'response' => $captchaResponse,
                'remoteip' => $request->ip(),
            ])->json();

            // If CAPTCHA validation fails
            if (!$result['success']) {
                return response()->json(['error' => 'CAPTCHA validation failed'], 403);
            }
        }

        return $next($request);
    }
}
