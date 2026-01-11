<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\License;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Support\Str;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = Tool::all();
        $users = User::all();
        
        foreach ($tools as $index => $tool) {
            // Create 1-2 licenses per tool
            $licenseCount = rand(1, 2);
            
            for ($i = 0; $i < $licenseCount; $i++) {
                $user = $users->random();
                
                License::create([
                    'tool_id' => $tool->id,
                    'user_id' => $user->id,
                    'license_key' => $this->generateLicenseKey(),
                    'domain' => 'example' . ($index + 1) . ($i + 1) . '.com',
                    'expires_at' => now()->addYear(),
                    'status' => 'active',
                    'max_downloads' => rand(1, 5),
                    'download_count' => rand(0, 2),
                ]);
            }
            
            // Create a few expired licenses
            if ($index < 3) {
                License::create([
                    'tool_id' => $tool->id,
                    'user_id' => $user->id,
                    'license_key' => $this->generateLicenseKey(),
                    'domain' => 'expired' . ($index + 1) . '.com',
                    'expires_at' => now()->subDays(30),
                    'status' => 'expired',
                    'max_downloads' => rand(1, 5),
                    'download_count' => rand(0, 2),
                ]);
            }
        }
    }
    
    private function generateLicenseKey(): string
    {
        $uuid = Str::uuid();
        $key = strtoupper(str_replace('-', '', $uuid));
        return 'GT10-' . substr($key, 0, 4) . '-' . substr($key, 4, 4) . '-' . substr($key, 8, 4) . '-' . substr($key, 12, 4);
    }
}