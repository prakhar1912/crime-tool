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
Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function(){
	Route::prefix('home')->group(function(){
		Route::get('/','PanelController@redirect');
		
		Route::post('crimes','PanelController@getAllCrimes');
		Route::post('add-new','PanelController@addNewCrime');
		Route::delete('crime/{id}','PanelController@deleteCrime');
		Route::patch('crime/{id}','PanelController@editCrime');

		Route::middleware(['role:admin'])->group(function(){
			Route::prefix('admin')->group(function(){
				Route::get('/','AdminController@show');
				Route::get('users','AdminController@users');
				Route::post('users','AdminController@getAllUsers');

				Route::get('stations','AdminController@stations');
				Route::post('stations','AdminController@getAllStations');
				Route::post('station/add-new','AdminController@addNewStation');
				Route::delete('station/{id}','AdminController@deleteStation');
				Route::patch('station/{id}','AdminController@editStation');

				Route::post('ban/{id}','AdminController@banUser');
				Route::post('unban/{id}','AdminController@unbanUser');

				Route::get('new','AdminController@newAdmin');
				Route::post('new','AdminController@createNewAdmin');
			});
		});

		Route::middleware(['role:commander'])->group(function(){
			Route::prefix('commander')->group(function(){
				Route::get('/','CommanderController@show');
				Route::post('crime/{id}','CommanderController@addCrimeNumber');
			});
		});

		Route::middleware(['role:director'])->group(function(){
			Route::prefix('director')->group(function(){
				Route::get('/','DirectorController@show');
			});
		});
	});
});

Route::get('/logout','Auth\LoginController@logout');
