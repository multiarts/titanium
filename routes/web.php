<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::view('/home', 'home')->name('home')->middleware('auth');

Route::get('/perfil', function () {
	return 'Perfil';
})->middleware('auth')->prefix('painel')->name('profile');

Route::prefix('painel')->name('dashboard.')->middleware('auth')->group(function () {
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
