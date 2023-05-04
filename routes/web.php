<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Feedback\ListController;
use App\Http\Controllers\Feedback\StoreController;

// Home
Route::get('/', function () {
    return redirect()->route('feedback.index');
});

// Feedback
Route::prefix('feedback')->group(function () {
    Route::get('/', ListController::class)->name('feedback.index');
    Route::get('/form', function() { return view('feedback.form'); })->name('feedback.form');
    Route::post('/form', StoreController::class)->name('feedback.store');
});

// Shopping list
Route::get('/shopping', function() { return view('shopping.index'); })->name('shopping.index');