<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ResetPasswordController;

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
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/hi', function () {
    return view('hi');
})->name('hi');

Route::post('/registration',[AuthManager::class,'registrationPost'])->name('registration.post');
Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post');
Route::get('/users/{id}', [AuthManager::class, 'getUser'])->name('getUser');
Route::put('/reset/{email}',[ResetPasswordController::class,'resetpostman']);