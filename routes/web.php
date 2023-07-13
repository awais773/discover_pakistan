<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [App\Http\Controllers\admin\EmailInvitationController::class, 'index']);
Route::post('/invitation/send', [App\Http\Controllers\admin\EmailInvitationController::class, 'sendInvitation'])->name('send.invite');
Route::post('/verify/otp', [App\Http\Controllers\admin\EmailInvitationController::class, 'otpVerification'])->name('verify.otp');

Route::post('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerUser'])->name('register.user');


Auth::routes();

Route::post('/change-passwords', [App\Http\Controllers\admin\EmailInvitationController::class, 'updatePassword']);
Route::get('/change-password', [App\Http\Controllers\admin\EmailInvitationController::class, 'changePassword']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', [App\Http\Controllers\admin\CategoryController::class, 'index']);
Route::get('/leaderboardlist', [App\Http\Controllers\admin\LeaderBoardController::class, 'index']);







// Route::get('/Users', [App\Http\Controllers\admin\UserController::class, 'index']);
Route::get('/User/{id}', [App\Http\Controllers\admin\UserController::class, 'edit']);
Route::Resource('/Users', App\Http\Controllers\admin\UserController::class);


Route::get('/Videocreate', [App\Http\Controllers\admin\VideoController::class, 'Videocreate']);
Route::Resource('/Video', App\Http\Controllers\admin\VideoController::class);




