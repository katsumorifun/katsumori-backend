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
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function (){
    Route::post('registration', [\App\Http\Controllers\Api\V1\Auth\RegistrationController::class, 'callBack'])->name('auth.registration.callback');
    Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login'])->name('auth.login.callback');
    Route::post('access_token', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'updateTokens']);
    Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LogOutController::class, 'logOut'])->name('auth.logout');
});

Route::prefix('devices')->group(function (){
    Route::get('/', [\App\Http\Controllers\Api\V1\DevicesApiController::class, 'listDevices']);
    Route::get('/current', [\App\Http\Controllers\Api\V1\DevicesApiController::class, 'currentDevice']);
    Route::get('/logout/all', [\App\Http\Controllers\Api\V1\DevicesApiController::class, 'logoutAll']);
    Route::get('/logout/{login_id}', [\App\Http\Controllers\Api\V1\DevicesApiController::class, 'logoutFromLoginId']);
});

Route::prefix('users')->group(function (){
    Route::get('/', [\App\Http\Controllers\Api\V1\UsersApiController::class, 'getList']);
    Route::get('/{user_id}', [\App\Http\Controllers\Api\V1\UsersApiController::class, 'getById']);
    Route::post('/{user_id}', [\App\Http\Controllers\Api\V1\UsersApiController::class, 'editProfile'])->middleware('auth:api');
    Route::post('/{user_id}/upload_avatar', [\App\Http\Controllers\Api\V1\UsersApiController::class, 'uploadAvatar'])->middleware('auth:api');
});

Route::prefix('anime')->group(function (){
    Route::get('/', [\App\Http\Controllers\Api\V1\AnimeApiController::class, 'list']);
    Route::get('search/{value}', [\App\Http\Controllers\Api\V1\AnimeApiController::class, 'search']);
    Route::get('/{id}', [\App\Http\Controllers\Api\V1\AnimeApiController::class, 'getItem']);
    Route::post('/{id}', [\App\Http\Controllers\Api\V1\AnimeApiController::class, 'update'])->middleware('auth:api');;
});
