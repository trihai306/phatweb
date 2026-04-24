<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WhyUsController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::prefix('ve-chung-toi')->name('about.')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('index');
    Route::get('/{slug}', [AboutController::class, 'show'])->name('show');
});

Route::prefix('dich-vu')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/thuc-don', [ServiceController::class, 'menu'])->name('menu');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

Route::prefix('tai-sao-chung-toi')->name('whyus.')->group(function () {
    Route::get('/', [WhyUsController::class, 'index'])->name('index');
    Route::get('/{slug}', [WhyUsController::class, 'show'])->name('show');
});

Route::prefix('tuyen-dung')->name('careers.')->group(function () {
    Route::get('/', [CareerController::class, 'index'])->name('index');
    Route::get('/{slug}', [CareerController::class, 'show'])->name('show');
});

Route::prefix('lien-lac')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/hoi-truc-tuyen', [ContactController::class, 'inquiry'])->name('inquiry');
    Route::post('/gui', [ContactController::class, 'store'])->name('store');
});
