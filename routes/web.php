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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group([
    'prefix' => 'admin',
    'middleware' => ['IsAdmin'],
    'namespace' => 'App\Http\Controllers\backend'
], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::resource('admin', 'AdminController');
    Route::get('adminview/pdf/{id}', 'AdminController@viewFilePDF')->name('adminview-pdf');
    Route::get('adminview/word/{id}', 'AdminController@viewFileWord')->name('adminview-word');
    Route::get('refer/{id}', 'AdminController@viewReferDe')->name('view-refer');
    Route::get('add/director/{id}', 'AdminController@viewAddDirector')->name('view-director');
    Route::post('refer/add', 'AdminController@addRefer')->name('refer-add');
    Route::post('director/add', 'AdminController@addDirector')->name('director-add');

    Route::get('re-send-director', 'AdminController@sendDirectorView')->name('send-director-pages');
    Route::get('view-director-feedback-1/{id}', 'FeedbackController@direcFeed1')->name('view-direc1');
    Route::get('view-director-feedback-2/{id}', 'FeedbackController@direcFeed2')->name('view-direc2');
    Route::get('view-director-feedback-3/{id}', 'FeedbackController@direcFeed3')->name('view-direc3');
    Route::get('send-detail/{id}', 'AdminController@sendDetail')->name('send-detail');
});

Route::group([
    'prefix' => 'user',
    'middleware' => ['Isuser'],
    'namespace' => 'App\Http\Controllers\backend'
], function () {
    Route::get('dashboard', [UserController::class, 'showResearch'])->name('user.dashboard');
    Route::get('view-detail/{id}', [UserController::class, 'detailResearch'])->name('view-datail');
    Route::resource('research', 'ResearchController');
    Route::get('userview/pdf/{id}', [UserController::class, 'viewFilePDF'])->name('userview-pdf');
    Route::get('userview/word/{id}', [UserController::class, 'viewFileWord'])->name('userview-word');
    //Route::post('insert-research',[UserController::class,'insertResearch'])->name('insert-research');
});

Route::group([
    'prefix' => 'director',
    'middleware' => ['IsDirector'],
    'namespace' => 'App\Http\Controllers\backend',
], function () {
    Route::get('dashboard', 'DirectorController@index')->name('director.dashboard');
    Route::get('view-detail/{id}', 'DirectorController@indexDetailView')->name('detail-view');
    Route::get('pages-feedback/{id}', 'DirectorController@addFeedback')->name('add-feed-pages');
    Route::post('add-feed', 'DirectorController@addFeed')->name('add-feed');
    Route::get('edit-feed/{id}', 'DirectorController@editFeed')->name('edit-feed');
    Route::get('directorview/pdf/{id}', 'DirectorController@viewFilePDF')->name('directorview-pdf');
    Route::get('directorview/word/{id}', 'DirectorController@viewFileWord')->name('directorview-word');
});
