<?php

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

Route::group(['middleware' => ['auth']], function () {

    //DocumentViewer Library
    Route::any('ViewerJS/{all?}', function(){
        return View::make('ViewerJS.index');
    });

    Route::get('/','HomeController@dashboard')->name('dashboard');

    Route::get('/users/profile','UserController@profile')->name('users.profile');
    // Route::put('/users/profile/update/{id}','UserController@profileUpdate')->name('users.profile.update');

    Route::get('/inbox','InboxController@inbox')->name('inbox');
    
    Route::get('/surat/detail/{id}','SuratController@detail')->name('surat.detail');
    Route::post('/surat/{id}/store','SuratController@save')->name('surat.save');

    Route::resources([
        'instansi' => 'InstansiController',
        'tipe-surat'=> 'TypeSuratController',
        'users'=> 'UserController',
        'surat'=> 'SuratController',
    ]);
    
});

Auth::routes();