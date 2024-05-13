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
Route::Resource('/Adds ', App\Http\Controllers\admin\AddsController::class);
Route::get('/addsCreate', [App\Http\Controllers\admin\AddsController::class, 'addsCreate']);
Route::get('/Add', [App\Http\Controllers\admin\AddsController::class, 'index']);
Route::post('/DiscoverShowsStore', [App\Http\Controllers\admin\AddsController::class, 'store']);


Route::get('AddEdit/{id}', [App\Http\Controllers\admin\AddsController::class, 'edit']);
Route::put('Addupdate/{id}', [App\Http\Controllers\admin\AddsController::class, 'update']);
Route::delete('Adddelete/{id}', [App\Http\Controllers\admin\AddsController::class, 'destroy']);


Route::Resource('/home', App\Http\Controllers\admin\HomeController::class);
Route::post('/SliderStore', [App\Http\Controllers\admin\HomeController::class, 'store']);
Route::get('/banerTax/{id}', [App\Http\Controllers\admin\HomeController::class, 'edit']);




Route::Resource('/category', App\Http\Controllers\admin\CategoryController::class);
Route::get('/CategoryCreate', [App\Http\Controllers\admin\CategoryController::class, 'create']);
Route::post('/Categorystore', [App\Http\Controllers\admin\CategoryController::class, 'store']);
Route::get('/Categoryedit/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit']);
Route::put('/CategoryUpdate/{id}', [App\Http\Controllers\admin\CategoryController::class, 'update']);
Route::delete('/CategoryDestroy/{id}', [App\Http\Controllers\admin\CategoryController::class, 'destroy']);


Route::Resource('/Job', App\Http\Controllers\admin\JobController::class);
Route::get('/JobCreate', [App\Http\Controllers\admin\JobController::class, 'create']);
Route::post('/Jobstore', [App\Http\Controllers\admin\JobController::class, 'store']);
Route::get('/Jobedit/{id}', [App\Http\Controllers\admin\JobController::class, 'edit']);
Route::put('/JobUpdate/{id}', [App\Http\Controllers\admin\JobController::class, 'update']);
Route::delete('/JobDestroy/{id}', [App\Http\Controllers\admin\JobController::class, 'destroy']);


Route::get('/contact', [App\Http\Controllers\admin\JobController::class, 'contact']);







