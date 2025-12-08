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
        $viteUrl = app()->isLocal() ? ' http://127.0.0.1:5173' : '';
        $viteWs = app()->isLocal() ? ' ws://127.0.0.1:5173' : '';

        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https:{$viteUrl}; " .
               "style-src 'self' 'unsafe-inline' https:{$viteUrl}; " .
               "img-src 'self' data: https: blob:{$viteUrl}; " .
               "font-src 'self' data: https:{$viteUrl}; " .
               "connect-src 'self' https:{$viteUrl}{$viteWs}; " .
               "frame-src 'self' https:;";
               
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
