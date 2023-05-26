<?php
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

// Route::post('/upload', [FileController::class, 'upload'])->name('upload');