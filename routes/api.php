<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TourismAgencyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersTypeController;
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

Route::group(['namespace' => 'Language', 'prefix' => 'language'], function () {
    Route::get('get-all-languages', [LanguageController::class, 'index'])->name('language.getAllLanguages');
});

Route::group(['namespace' => 'UserTypes', 'prefix' => 'userTypes'], function () {
    Route::get('get-all-UserTypes', [UsersTypeController::class, 'index'])->name('userTypes.getAllUserTypes');
});


Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
    Route::post('register-user', [UserController::class, 'create'])->name('user.registerUser');
    Route::post('login-user', [UserController::class, 'login'])->name('user.loginUser');

});


Route::group(['namespace' => 'TourGuide', 'prefix' => 'tourGuide'], function () {
    Route::post('register-tourGuide', [TourGuideController::class, 'create'])->name('tourGuide.registerTourGuide');
    Route::post('login-tourGuide', [TourGuideController::class, 'login'])->name('tourGuide.loginTourGuide');

});

Route::group(['namespace' => 'TourismAgency', 'prefix' => 'tourismAgency'], function () {
    Route::post('register-tourismAgency', [TourismAgencyController::class, 'create'])->name('tourismAgency.registerTourismAgency');
    Route::post('login-tourismAgency', [TourismAgencyController::class, 'login'])->name('tourismAgency.loginTourismAgency');

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
