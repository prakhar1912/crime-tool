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

Route::post('login','LoginController@login');

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function(){
	Route::prefix('home')->group(function(){
		Route::get('/','PanelController@redirect');
		
		Route::post('crimes','CrimeController@getAllCrimes');
		Route::post('add-new','CrimeController@addNewCrime');
		Route::delete('crime/{id}','CrimeController@deleteCrime');
		Route::patch('crime/{id}','CrimeController@editCrime');

		Route::post('case','ReportController@addNewCase');
		Route::post('cases','ReportController@getAllCases');
		Route::post('case/{case}/comments','ReportController@getAllComments');
		Route::post('case/{case}/comment','ReportController@addNewComment');
		Route::post('case/{case}','ReportController@getCaseDetails');
		
		Route::post('stations','StationController@getStations');
		Route::post('stations/all','StationController@getAllStations');
		Route::post('station/{station}/cases','StationController@getCases');

		Route::middleware(['role:admin'])->group(function(){
			Route::prefix('admin')->group(function(){
				Route::get('/','AdminController@show');
				Route::get('users','AdminController@users');
				Route::post('users','AdminController@getAllUsers');

				Route::get('stations','AdminController@stations');
				Route::post('station/add-new','AdminController@addNewStation');
				Route::delete('station/{id}','AdminController@deleteStation');
				Route::patch('station/{id}','AdminController@editStation');

				Route::post('ban/{id}','AdminController@banUser');
				Route::post('unban/{id}','AdminController@unbanUser');

				Route::get('new','AdminController@newAdmin');
				Route::post('new','AdminController@createNewAdmin');

				Route::get('report','AdminController@showReport');
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
				Route::get('crime/{crime}','DirectorController@showCases');
				Route::get('case/{case}','DirectorController@showCase');
				Route::get('stations','DirectorController@casesPerStation');
				Route::get('cases','DirectorController@showAllCases');
				Route::get('commanders','DirectorController@showAllCommanders');
				Route::post('commanders/all','DirectorController@getAllCommanders');
				Route::patch('commanders/{commander}','DirectorController@reassignCommander');
			});
		});
	});
});

Route::get('/logout','Auth\LoginController@logout');
