<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Models\Experience;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'whatsapp' => '529993292148',
        'phoneLabel' => '9993 29 21 48',
        'upcomingExperiences' => Schema::hasTable('experiences')
            ? Experience::where('status', 'published')
                ->orderByDesc('is_featured')
                ->orderBy('event_date')
                ->orderBy('sort_order')
                ->get()
            : collect(),
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('experiences', ExperienceController::class)->except(['show']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
