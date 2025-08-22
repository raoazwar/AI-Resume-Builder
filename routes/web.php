<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('resumes', ResumeController::class);
    Route::post('resumes/{resume}/export', [ResumeController::class, 'export'])->name('resumes.export');
    Route::post('resumes/{resume}/optimize', [ResumeController::class, 'optimize'])->name('resumes.optimize');
    Route::get('resumes/{resume}/analyze', [ResumeController::class, 'analyze'])->name('resumes.analyze');
    
    // Feedback routes
    Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
