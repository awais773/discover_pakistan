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

Route::post('register',[App\Http\Controllers\api\AuthController::class,'register']);
Route::post('login',[App\Http\Controllers\api\AuthController::class,'login']);
// Route::post('login',[App\Http\Controllers\api\AuthenticateController::class,'login']);
Route::post('forgotPassword',[App\Http\Controllers\api\AuthenticateController::class,'forgotPassword']);
Route::post('otpVerification',[App\Http\Controllers\api\AuthenticateController::class,'otpVerification']);


// Route::post('/forgotPassword', [App\Http\Controllers\api\AuthenticateController::class, 'forgotPassword']);
Route::post('/updatePassword', [App\Http\Controllers\api\AuthenticateController::class, 'updatePassword']);

Route::get('/Users', [App\Http\Controllers\api\AuthenticateController::class, 'index']);
Route::get('/getUsers/{id}', [App\Http\Controllers\api\AuthenticateController::class, 'show']);

Route::post('Video',[App\Http\Controllers\api\AuthController::class,'Video']);
Route::post('VideosGet',[App\Http\Controllers\api\AuthController::class,'VideosGet']);
Route::post('shortsGet',[App\Http\Controllers\api\AuthController::class,'shortsGet']);
Route::get('Videos/{id}',[App\Http\Controllers\api\AuthController::class,'Videos']);
Route::delete('videosDestroy/{id}',[App\Http\Controllers\api\AuthController::class,'videosDestroy']);

Route::get('addsGet/{id}',[App\Http\Controllers\api\AuthController::class,'addShow']);
Route::post('addsGet',[App\Http\Controllers\api\AuthController::class,'addsGet']);
Route::get('bannerTaxt',[App\Http\Controllers\api\AuthController::class,'bannerTaxt']);
Route::get('SliderImage',[App\Http\Controllers\api\AuthController::class,'SliderImage']);
Route::get('DiscoverShowSlider',[App\Http\Controllers\api\AuthController::class,'DiscoverShowSlider']);
Route::get('DiscoverShowImages',[App\Http\Controllers\api\AuthController::class,'DiscoverShowImages']);



Route::post('joinUs',[App\Http\Controllers\api\AuthController::class,'Contact']);
Route::post('Adverstise',[App\Http\Controllers\api\AuthController::class,'Adverstise']);



Route::get('homeVideo',[App\Http\Controllers\api\AuthController::class,'HomeVideo']);
Route::post('search',[App\Http\Controllers\api\AuthController::class,'allVideo']);
Route::post('payment',[App\Http\Controllers\api\AuthController::class,'stripePost']);

Route::get('Category',[App\Http\Controllers\api\AuthController::class,'Category']);

// email/
Route::post('email',[App\Http\Controllers\api\AuthController::class,'email']);
Route::get('Jobs',[App\Http\Controllers\api\AuthController::class,'Job']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->group(function () {
    Route::post('/update/profile', [App\Http\Controllers\api\AuthenticateController::class, 'updateProfile']);
    Route::post('PasswordChanged',[App\Http\Controllers\api\AuthController::class,'PasswordChanged']);
    Route::post('checkPayment',[App\Http\Controllers\api\AuthController::class,'checkPayment']);

});






