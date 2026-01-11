<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\License;
use Illuminate\Support\Facades\Log;

class LicenseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $licenseKey = $request->route('license_key') ?? $request->header('X-License-Key');
        
        if (!$licenseKey) {
            return response()->json(['error' => 'License key is required'], 400);
        }

        $license = License::where('license_key', $licenseKey)->first();
        
        if (!$license) {
            return response()->json(['error' => 'Invalid license key'], 401);
        }

        // Check if license is active
        if ($license->status !== 'active') {
            return response()->json(['error' => 'License is not active'], 401);
        }

        // Check if license is expired
        if ($license->expires_at && $license->expires_at->isPast()) {
            $license->update(['status' => 'expired']);
            return response()->json(['error' => 'License has expired'], 401);
        }

        // Check domain match
        $domain = parse_url($request->header('Referer') ?? $request->getHost(), PHP_URL_HOST) ?: $request->getHost();
        if ($license->domain !== $domain && !str_ends_with($domain, '.' . $license->domain)) {
            Log::warning("Domain mismatch for license {$licenseKey}", [
                'expected' => $license->domain,
                'actual' => $domain
            ]);
            return response()->json(['error' => 'Domain not authorized'], 401);
        }

        // Check download limit
        if ($license->download_count >= $license->max_downloads) {
            return response()->json(['error' => 'Download limit exceeded'], 401);
        }

        // Pass the license to the next request
        $request->merge(['license' => $license]);

        return $next($request);
    }
}