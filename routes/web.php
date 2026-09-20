<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormEntryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit')
    ->middleware('throttle:10,1');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function (): void {
    // Guest Auth
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Authenticated Admin Panel
    Route::middleware('auth')->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Posts (TipTap rich text editor)
        Route::resource('posts', App\Http\Controllers\Admin\PostController::class);

        // Projects (Portfolio)
        Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);

        // Services (Catalog)
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);

        // Media Library & Uploads
        Route::resource('media', MediaController::class)->except(['create', 'edit', 'show']);

        // Form Inquiries / Entries
        Route::get('/forms/entries', [FormEntryController::class, 'index'])->name('forms.entries.index');
        Route::get('/forms/entries/{entry}', [FormEntryController::class, 'show'])->name('forms.entries.show');
        Route::patch('/forms/entries/{entry}/status', [FormEntryController::class, 'updateStatus'])->name('forms.entries.status');
        Route::delete('/forms/entries/{entry}', [FormEntryController::class, 'destroy'])->name('forms.entries.destroy');

        // Site Settings
        Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
    });
});
