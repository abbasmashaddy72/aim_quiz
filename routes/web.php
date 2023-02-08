<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
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

// Frontend URL
Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    Route::get('/', 'FrontendController@index')->name('homepage');

    Route::get('/change-language/{lang}', 'LanguageController@changeLanguage');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'verified'], 'namespace' => 'App\Http\Controllers\Backend'], function () {
    Route::get('dashboard', function () {
        view()->share('title', 'Dashboard');
        return view('dashboard');
    })->name('dashboard');

    Route::get('role', 'RoleController@index')->name('role');
    Route::get('user', 'UserController@index')->name('user');

    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    Route::delete('/profile', 'ProfileController@destroy')->name('profile.destroy');

    Route::get('/{user}/impersonate', 'UserController@impersonate')->name('users.impersonate');
    Route::get('/leave-impersonate', 'UserController@leaveImpersonate')->name('users.leave-impersonate');

    Route::get('topic', 'TopicController@index')->name('topic');
    Route::get('question', 'QuestionController@index')->name('question');
    Route::get('quiz_user', 'QuizUserController@index')->name('quiz_user');
    Route::get('result', 'ResultController@index')->name('result');
});

require __DIR__ . '/auth.php';
