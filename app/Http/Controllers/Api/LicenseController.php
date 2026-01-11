<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Tool;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class LicenseController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'domain' => 'required|url',
            'days' => 'required|integer|min:1|max:3650', // Max 10 years
        ]);

        $tool = Tool::findOrFail($request->tool_id);
        
        $licenseKey = $this->generateLicenseKey();
        
        $license = License::create([
            'tool_id' => $request->tool_id,
            'license_key' => $licenseKey,
            'domain' => parse_url($request->domain, PHP_URL_HOST) ?: $request->domain,
            'expires_at' => now()->addDays($request->days),
            'status' => 'active',
            'max_downloads' => 5, // Default 5 downloads
        ]);

        return response()->json([
            'success' => true,
            'license_key' => $licenseKey,
            'expires_at' => $license->expires_at->toISOString(),
            'tool' => [
                'id' => $license->tool->id,
                'name' => $license->tool->name,
                'version' => $license->tool->version,
            ]
        ], 201);
    }

    public function verify(string $licenseKey, Request $request): JsonResponse
    {
        $domain = $request->query('domain');
        
        if (!$domain) {
            return response()->json([
                'valid' => false,
                'message' => 'Domain parameter is required'
            ], 400);
        }

        $license = License::where('license_key', $licenseKey)->first();
        
        if (!$license) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid license key'
            ], 404);
        }

        // Check if license is active
        if ($license->status !== 'active') {
            return response()->json([
                'valid' => false,
                'message' => 'License is not active'
            ], 403);
        }

        // Check domain match
        $parsedDomain = parse_url($domain, PHP_URL_HOST) ?: $domain;
        if ($license->domain !== $parsedDomain && !str_ends_with($parsedDomain, '.' . $license->domain)) {
            return response()->json([
                'valid' => false,
                'message' => 'Domain not authorized'
            ], 403);
        }

        // Check if license is expired
        if ($license->expires_at && $license->expires_at->isPast()) {
            $license->update(['status' => 'expired']);
            return response()->json([
                'valid' => false,
                'message' => 'License has expired'
            ], 403);
        }

        // Return successful validation
        return response()->json([
            'valid' => true,
            'license' => [
                'key' => $license->license_key,
                'tool_id' => $license->tool_id,
                'tool_name' => $license->tool->name,
                'tool_version' => $license->tool->version,
                'expires_at' => $license->expires_at->toISOString(),
                'download_limit' => $license->max_downloads,
                'download_count' => $license->download_count,
            ]
        ]);
    }

    public function validateWithIp(string $licenseKey, Request $request): JsonResponse
    {
        $domain = $request->query('domain');
        $ip = $request->ip(); // Get client IP
        
        if (!$domain) {
            return response()->json([
                'valid' => false,
                'message' => 'Domain parameter is required'
            ], 400);
        }

        $license = License::where('license_key', $licenseKey)
                         ->where('domain', parse_url($domain, PHP_URL_HOST) ?: $domain)
                         ->first();
        
        if (!$license) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid license key or domain'
            ], 404);
        }

        // Check if license is active
        if ($license->status !== 'active') {
            return response()->json([
                'valid' => false,
                'message' => 'License is not active'
            ], 403);
        }

        // Check if license is expired
        if ($license->expires_at && $license->expires_at->isPast()) {
            $license->update(['status' => 'expired']);
            return response()->json([
                'valid' => false,
                'message' => 'License has expired'
            ], 403);
        }

        // All checks passed
        return response()->json([
            'valid' => true,
            'license' => [
                'key' => $license->license_key,
                'tool_id' => $license->tool_id,
                'tool_name' => $license->tool->name,
                'expires_at' => $license->expires_at->toISOString(),
            ]
        ]);
    }

    private function generateLicenseKey(): string
    {
        $uuid = Str::uuid();
        $key = strtoupper(str_replace('-', '', $uuid));
        return 'GT10-' . substr($key, 0, 4) . '-' . substr($key, 4, 4) . '-' . substr($key, 8, 4) . '-' . substr($key, 12, 4);
    }
}