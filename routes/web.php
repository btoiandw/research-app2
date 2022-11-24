<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DirectorController;

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

/* Route::get('/', function () {
    return view('login');
}); */

Route::get('/', function(){
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group([
    'prefix'=>'admin',
    'middleware'=>['auth']
], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
});

Route::group([
    'prefix'=>'user',
    'middleware'=>['auth']
], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::post('insert-research',[UserController::class,'insertResearch'])->name('insert-research');
});

Route::group([
    'prefix'=>'director',
    'middleware'=>['auth']
], function(){
    Route::get('dashboard',[DirectorController::class,'index'])->name('director.dashboard');
    Route::get('profile',[DirectorController::class,'profile'])->name('director.profile');
});