<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimaryFormController;

// Example route for the apps.php file
Route::middleware(['auth'])->group(function () {
    Route::get('/primaryform', [PrimaryFormController::class, 'index'])->name('primaryform.index');
    Route::post('/primaryform', [PrimaryFormController::class, 'store'])->name('primaryform.store');
});
