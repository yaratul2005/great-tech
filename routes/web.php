<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Pages
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tools', function () {
    return view('pages.tools');
})->name('tools');

Route::get('/docs', function () {
    return view('pages.documentation');
})->name('docs');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// License Routes
Route::get('/license/purchase', function () {
    return view('pages.license.purchase');
})->name('license.purchase');

// Admin Routes - Protected with admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Tool Management
    Route::resource('tools', ToolController::class);
    
    // License Management
    Route::resource('licenses', LicenseController::class);
    
    // License actions
    Route::post('/licenses/{license}/revoke', [LicenseController::class, 'revoke'])->name('licenses.revoke');
    Route::post('/licenses/{license}/renew', [LicenseController::class, 'renew'])->name('licenses.renew');
    
    // Tool licenses
    Route::get('/tools/{tool}/licenses', function (\App\Models\Tool $tool) {
        $licenses = $tool->licenses()->with('user')->paginate(10);
        return view('admin.licenses.index', compact('licenses'));
    })->name('tools.licenses');
});

// Product Categories
Route::get('/themes', function () {
    return view('pages.categories.themes');
})->name('themes');

Route::get('/plugins', function () {
    return view('pages.categories.plugins');
})->name('plugins');

Route::get('/bots', function () {
    return view('pages.categories.bots');
})->name('bots');

// Protected Download Route
Route::get('/download/{license_key}', [DownloadController::class, 'download'])->name('download.license');

// Utility Routes
Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/licenses', function () {
    return view('pages.licenses');
})->name('licenses');

// API Routes for dynamic content (would be handled separately in a real app)
Route::get('/api/products', function () {
    return response()->json([
        ['id' => 1, 'name' => 'Elegant Business Theme', 'price' => 59],
        ['id' => 2, 'name' => 'Advanced Contact Form', 'price' => 29],
        // More products would be returned here
    ]);
});