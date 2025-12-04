<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Permissive CSP to fix deployment issues
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; " .
               "style-src 'self' 'unsafe-inline' https:; " .
               "img-src 'self' data: https: blob:; " .
               "font-src 'self' data: https:; " .
               "connect-src 'self' https:; " .
               "frame-src 'self' https:;";
               
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
