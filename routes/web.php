<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\DetailResearch;
use App\Http\Controllers\DetailResearch as ControllersDetailResearch;
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


Route::get('/welcome',function(){
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group([
    'prefix'=>'admin',
    'middleware'=>['IsAdmin'],
    'namespace'=>'App\Http\Controllers\backend'
], function(){
    Route::get('dashboard','AdminController@index')->name('admin.dashboard');
    Route::resource('admin','AdminController');
    Route::get('view/pdf/{id}','AdminController@viewFilePDF')->name('view-pdf');
    Route::get('view/word/{id}','AdminController@viewFileWord')->name('view-word');
    //Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    
    //Route::get('detail/{id}',[AdminController::class,'showDetail'])->name('show-detail');
});

Route::group([
    'prefix'=>'user',
    'middleware'=>['Isuser'],
    'namespace'=>'App\Http\Controllers\backend'
], function(){
    Route::get('dashboard',[UserController::class,'showResearch'])->name('user.dashboard');
    Route::resource('research','ResearchController');
    //Route::post('insert-research',[UserController::class,'insertResearch'])->name('insert-research');
});

Route::group([
    'prefix'=>'director',
    'middleware'=>['IsDirector'],
    
], function(){
    Route::get('dashboard',[DirectorController::class,'index'])->name('director.dashboard');
    Route::get('profile',[DirectorController::class,'profile'])->name('director.profile');
});