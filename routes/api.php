<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LicenseController;
use App\Http\Controllers\Api\ToolController;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// License API endpoints
Route::prefix('licenses')->group(function () {
    // Generate a new license
    Route::post('/generate', [LicenseController::class, 'generate']);
    
    // Verify a license key
    Route::get('/{licenseKey}/verify', [LicenseController::class, 'verify']);
    
    // Enhanced verification with IP tracking
    Route::get('/{licenseKey}/validate', [LicenseController::class, 'validateWithIp']);
});

// Tool API endpoints
Route::prefix('tools')->group(function () {
    Route::get('/', [ToolController::class, 'index']);
    Route::get('/{slug}', [ToolController::class, 'show']);
});

// Protected download endpoint
Route::post('/downloads/{license_key}', [DownloadController::class, 'verifyAndDownload'])
    ->middleware('throttle:10,1'); // Limit to 10 requests per minute