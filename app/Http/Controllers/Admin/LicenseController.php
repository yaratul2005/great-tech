<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::with(['tool', 'user'])->paginate(15);
        return view('admin.licenses.index', compact('licenses'));
    }

    public function create()
    {
        $tools = Tool::where('status', 'published')->get();
        $users = User::all();
        return view('admin.licenses.create', compact('tools', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'user_id' => 'nullable|exists:users,id',
            'domain' => 'required|url',
            'expires_at' => 'nullable|date',
            'max_downloads' => 'required|integer|min:1',
        ]);

        $licenseKey = $this->generateLicenseKey();

        License::create([
            'tool_id' => $request->tool_id,
            'user_id' => $request->user_id,
            'license_key' => $licenseKey,
            'domain' => $request->domain,
            'expires_at' => $request->expires_at,
            'status' => 'active',
            'max_downloads' => $request->max_downloads,
            'download_count' => 0,
        ]);

        return redirect()->route('admin.licenses.index')->with('success', 'License created successfully with key: ' . $licenseKey);
    }

    public function show(License $license)
    {
        return view('admin.licenses.show', compact('license'));
    }

    public function edit(License $license)
    {
        $tools = Tool::where('status', 'published')->get();
        $users = User::all();
        return view('admin.licenses.edit', compact('license', 'tools', 'users'));
    }

    public function update(Request $request, License $license)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'user_id' => 'nullable|exists:users,id',
            'domain' => 'required|url',
            'expires_at' => 'nullable|date',
            'status' => 'required|in:active,expired,revoked,suspended',
            'max_downloads' => 'required|integer|min:1',
        ]);

        $license->update([
            'tool_id' => $request->tool_id,
            'user_id' => $request->user_id,
            'domain' => $request->domain,
            'expires_at' => $request->expires_at,
            'status' => $request->status,
            'max_downloads' => $request->max_downloads,
        ]);

        return redirect()->route('admin.licenses.index')->with('success', 'License updated successfully.');
    }

    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('admin.licenses.index')->with('success', 'License deleted successfully.');
    }

    public function revoke(License $license)
    {
        $license->update(['status' => 'revoked']);
        return redirect()->back()->with('success', 'License revoked successfully.');
    }

    public function renew(License $license)
    {
        $license->update([
            'status' => 'active',
            'expires_at' => now()->addYear()
        ]);
        return redirect()->back()->with('success', 'License renewed successfully.');
    }

    private function generateLicenseKey(): string
    {
        $uuid = Str::uuid();
        $key = strtoupper(str_replace('-', '', $uuid));
        return 'GT10-' . substr($key, 0, 4) . '-' . substr($key, 4, 4) . '-' . substr($key, 8, 4) . '-' . substr($key, 12, 4);
    }
}