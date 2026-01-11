<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Tool;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    public function download(Request $request, string $licenseKey)
    {
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
        $domain = $request->header('Referer') ? parse_url($request->header('Referer'), PHP_URL_HOST) : $request->getHost();
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

        // Find the tool
        $tool = Tool::find($license->tool_id);
        if (!$tool) {
            return response()->json(['error' => 'Tool not found'], 404);
        }

        // Increment download count
        $license->increment('download_count');

        // Record the download
        Download::create([
            'license_id' => $license->id,
            'tool_id' => $tool->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Serve the file
        if (!Storage::disk('public')->exists($tool->file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->download(
            Storage::disk('public')->path($tool->file_path),
            basename($tool->file_path)
        );
    }

    public function verifyAndDownload(Request $request)
    {
        $licenseKey = $request->input('license');
        $domain = $request->input('domain');
        
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

        // Check domain match if provided
        if ($domain) {
            $domain = parse_url($domain, PHP_URL_HOST) ?: $domain;
            if ($license->domain !== $domain && !str_ends_with($domain, '.' . $license->domain)) {
                Log::warning("Domain mismatch for license {$licenseKey}", [
                    'expected' => $license->domain,
                    'actual' => $domain
                ]);
                return response()->json(['error' => 'Domain not authorized'], 401);
            }
        }

        // Check if license is expired
        if ($license->expires_at && $license->expires_at->isPast()) {
            $license->update(['status' => 'expired']);
            return response()->json(['error' => 'License has expired'], 401);
        }

        // Check download limit
        if ($license->download_count >= $license->max_downloads) {
            return response()->json(['error' => 'Download limit exceeded'], 401);
        }

        // Find the tool
        $tool = Tool::find($license->tool_id);
        if (!$tool) {
            return response()->json(['error' => 'Tool not found'], 404);
        }

        // Increment download count
        $license->increment('download_count');

        // Record the download
        Download::create([
            'license_id' => $license->id,
            'tool_id' => $tool->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Serve the file
        if (!Storage::disk('public')->exists($tool->file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->download(
            Storage::disk('public')->path($tool->file_path),
            basename($tool->file_path)
        );
    }
}