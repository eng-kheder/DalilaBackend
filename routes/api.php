<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RequestsController;
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



Route::group(['namespace' => 'UserTypes', 'prefix' => 'userTypes'], function () {
    Route::get('get-all-UserTypes', [UsersTypeController::class, 'index'])->name('userTypes.getAllUserTypes');
});


Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
    Route::post('register-user', [UserController::class, 'create'])->name('user.registerUser');
    Route::post('login-user', [UserController::class, 'login'])->name('user.loginUser');
    Route::get('get-user/{id}', [UserController::class, 'getUser'])->name('user.getUser');
    Route::get('search/{name}', [UserController::class, 'search'])->name('user.search');
    Route::get('get-user-requests/{userId}', [UserController::class, 'getUserRequests'])->name('user.getUserRequests');

});


Route::group(['namespace' => 'TourGuide', 'prefix' => 'tourGuide'], function () {
    Route::post('register-tourGuide', [TourGuideController::class, 'create'])->name('tourGuide.registerTourGuide');
    Route::post('login-tourGuide', [TourGuideController::class, 'login'])->name('tourGuide.loginTourGuide');
    Route::post('update-tourGuide/{id}', [TourGuideController::class, 'update'])->name('tourGuide.updateTourGuide');
    Route::get('get-all-guides', [TourGuideController::class, 'getAllGuides'])->name('tourGuide.getAllGuides');
    Route::get('get-guide/{id}', [TourGuideController::class, 'getGuide'])->name('tourGuide.getGuide');
    Route::get('get-guide-requests/{guideId}', [TourGuideController::class, 'getGuideRequests'])->name('tourGuide.getGuideRequests');
    Route::get('get-guide-rates/{guideId}', [TourGuideController::class, 'getGuideRates'])->name('tourGuide.getGuideRates');

});

Route::group(['namespace' => 'TourismAgency', 'prefix' => 'tourismAgency'], function () {
    Route::post('register-tourismAgency', [TourismAgencyController::class, 'create'])->name('tourismAgency.registerTourismAgency');
    Route::post('login-tourismAgency', [TourismAgencyController::class, 'login'])->name('tourismAgency.loginTourismAgency');
    Route::post('update-tourismAgency/{id}', [TourismAgencyController::class, 'update'])->name('tourismAgency.updateTourismAgency');
    Route::get('get-all-agencies', [TourismAgencyController::class, 'getAllAgencies'])->name('tourismAgency.getAllAgencies');
    Route::get('get-agency/{id}', [TourismAgencyController::class, 'getAgency'])->name('tourismAgency.getAgency');
    Route::get('get-agency-requests/{agencyId}', [TourismAgencyController::class, 'getAgencyRequests'])->name('tourismAgency.getAgencyRequests');
    Route::get('get-agency-rates/{agencyId}', [TourismAgencyController::class, 'getAgencyRates'])->name('tourismAgency.getAgencyRates');

});

Route::group(['namespace' => 'Request', 'prefix' => 'request'], function () {
    Route::get('cancel-request/{id}', [RequestsController::class, 'delete'])->name('request.cancelRequest');
    Route::post('add-request', [RequestsController::class, 'create'])->name('request.addRequest');
    Route::post('update-request-status', [RequestsController::class, 'updateRequestStatus'])->name('request.updateRequestStatus');

});


Route::group(['namespace' => 'Report', 'prefix' => 'report'], function () {
    Route::post('add-report', [ReportsController::class, 'create'])->name('report.addReport');

});

Route::group(['namespace' => 'Rate', 'prefix' => 'rate'], function () {
    Route::post('add-rate', [RatesController::class, 'create'])->name('rate.addRate');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('delete-guide/{id}', [AdminController::class, 'deleteGuide'])->name('admin.deleteGuide');
    Route::get('delete-agency/{id}', [AdminController::class, 'deleteAgency'])->name('admin.deleteAgency');
    Route::get('get-all-reports', [AdminController::class, 'getAllReports'])->name('admin.getAllReports');
    Route::post('register-admin', [AdminController::class, 'create'])->name('admin.registerAdmin');
    Route::post('login-admin', [AdminController::class, 'login'])->name('admin.loginAdmin');
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
