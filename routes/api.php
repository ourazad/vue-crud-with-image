<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/students',[App\Http\Controllers\StudentController::class, 'index']);
//Route::relation between DB('/path',[App\Http\Controllers\(controllerName)Controller::class, 'method name from controller']);

Route::get('/students',[App\Http\Controllers\StudentController::class, 'index']);
Route::post('/save',[App\Http\Controllers\StudentController::class, 'store']);
Route::put('/update/{id}',[App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/delete/{id}',[App\Http\Controllers\StudentController::class, 'destroy']);

Route::get('/teachers',[App\Http\Controllers\TeacherController::class, 'index']);
Route::post('/teachers_save',[App\Http\Controllers\TeacherController::class, 'store']);
Route::put('/teachers_update/{id}',[App\Http\Controllers\TeacherController::class, 'update']);
Route::delete('/teachers_delete/{id}',[App\Http\Controllers\TeacherController::class, 'destroy']);

Route::get('/staffs',[App\Http\Controllers\StaffController::class, 'index']);
Route::post('/staff_save',[App\Http\Controllers\StaffController::class, 'store']);
Route::put('/staff_update/{id}',[App\Http\Controllers\StaffController::class, 'update']);
Route::delete('/staff_delete/{id}',[App\Http\Controllers\StaffController::class, 'destroy']);

Route::get('/file_index',[App\Http\Controllers\FileController::class, 'index']);
Route::post('/file_upload',[App\Http\Controllers\FileController::class, 'upload']);

Route::get('/file',[App\Http\Controllers\FileController::class, 'index']);
Route::post('file_save',[App\Http\Controllers\FileController::class, 'store']);
Route::put('/file_update/{id}',[App\Http\Controllers\FileController::class, 'update']);
Route::delete('/file_delete/{id}',[App\Http\Controllers\FileController::class, 'destroy']);