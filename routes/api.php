<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'show');
    Route::post('/user', 'add');
    Route::patch('/user/employee/{employee_id}', 'update');
    Route::delete('/user/employee/{employee_id}', 'delete');
});
