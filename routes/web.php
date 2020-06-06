<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', function () {
// 	return view('welcome');
// })->middleware('auth');

Route::get('/home', function () {
	return view('home');
})->name('home')->middleware('auth');

Route::name('dashboard.')->middleware('auth')->group(function () {
	Route::view('/', 'admin.dashboard')->middleware('can:gerente');

	Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);

	Route::get('/tecnicos/pdf/{id}','TecnicosController@pdf')->name('pdf');
	Route::get('/tecnicos/showPDF/{id}','TecnicosController@pdfGeneral')->name('pdfGeneral');
	Route::resource('/tecnicos', 'TecnicosController');

	Route::get('/chamados/status/{status}', 'ChamadosController@abertos')->name('chamados.abertos');
	Route::get('/chamados/abertos', 'ChamadosController@abertos')->name('chamados.abertos');
	Route::get('/chamados/concluido', 'ChamadosController@concluido')->name('chamados.concluido');
	Route::get('/chamados/pendentes', 'ChamadosController@pendentes')->name('chamados.pendentes');
	Route::resource('/chamados', 'ChamadosController');
});

Route::get('/get-cidades/{idEstado}', 'TecnicosController@getCidades')->middleware('auth');
Route::get('/gettecnicos', 'TecnicosController@getTecnicos');
Route::post('/ajaxpost', 'TecnicosController@ajaxpost');
Route::get('/getSubClient/{id}', 'ChamadosController@getSubClient');
