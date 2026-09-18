<?php

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
