<?php

//use Illuminate\Routing\Route;
//use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();



Route::namespace('Auth')->group(function() {
    Route::view('/login', 'login')->name('login');

    Route::post('/login', [
        'as' => 'login.check',
        'uses' => 'LoginController@login'
    ]);

    Route::get('/sair', [
        'as' => 'logout',
        'uses' => 'LoginController@logout'
    ]);
});


Route::get('/', 'HomeController@index')->name('home');

Route::resource('origem', 'OriginController');

Route::prefix('localizacao')->group(function() {

    Route::get('/', [
        'as' => 'location.index',
        'uses' => 'LocationController@index'
    ]);

    Route::get('/cadastro', [
        'as' => 'location.create',
        'uses' => 'LocationController@create'
    ]);

    Route::post('/', [
        'as' => 'location.store',
        'uses' => 'LocationController@store'
    ]);

    Route::get('/{id}', [
        'as' => 'location.edit',
        'uses' => 'LocationController@edit'
    ]);

    Route::put('/{id}', [
        'as' => 'location.update',
        'uses' => 'LocationController@update'
    ]);

    Route::delete('/{id}', [
        'as' => 'location.destroy',
        'uses' => 'LocationController@destroy'
    ]);
});

Route::prefix('patrimonio')->group(function () {

    Route::get('/', [
        'as' => 'patrimony.index',
        'uses' => 'PatrimonyController@index'
    ]);

    Route::get('/form', [
        'as' => 'patrimony.form',
        'uses' => 'PatrimonyController@create'
    ]);

    Route::post('/', [
        'as' => 'patrimony.store',
        'uses' => 'PatrimonyController@store'
    ]);

    Route::post('/store-manual', [
        'as' => 'patrimony.store.manual',
        'uses' => 'PatrimonyController@storeManual'
    ]);

    Route::get('/edit/{id}', [
        'as' => 'patrimony.edit',
        'uses' => 'PatrimonyController@edit'
    ]);
    Route::put('update/{id}', [
        'as' => 'patrimony.update',
        'uses' => 'PatrimonyController@update'
    ]);
    Route::delete('/{id}', [
        'as' => 'patrimony.destroy',
        'uses' => 'PatrimonyController@destroy'
    ]);


    Route::get('/form-relatorio', [
        'as' => 'patrimony.form.relatorio',
        'uses' => 'PatrimonyController@showFormReport'
    ]);

    Route::get('/relatorio', [
        'as' => 'patrimony.report',
        'uses' => 'PatrimonyController@report'
    ]);

    Route::get('/relatorio-pdf', [
        'as' => 'patrimony.report.pdf',
        'uses' => 'ReportController@index'
    ]);

});

Route::prefix('usuarios')->group(function () {

    Route::get('/', [
        'as' => 'adminindex',
        'uses' => 'UserController@index'
    ]);

    Route::get('/cadastrar', [
        'as' => 'user.create',
        'uses' => 'UserController@create'
    ]);

    Route::get('/{id}', [
        'as' => 'user.edit',
        'uses' => 'UserController@edit'
    ]);

    Route::post('/', [
        'as' => 'user.store',
        'uses' => 'UserController@store'
    ]);

    Route::put('/{id}', [
        'as' => 'user.update',
        'uses' => 'UserController@update'
    ]);

    Route::delete('/{id}', [
        'as' => 'user.delete',
        'uses' => 'UserController@destroy'
    ]);
});

Route::fallback(function () {
    return view('404');
});
