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



Route::get('/', function (){

    return response()->redirectTo('dist/index.php');
});

Route::group(['prefix'=>'api'],function (){

    Route::resource('abonnements', 'AbonnementController');
    Route::resource('competences', 'CompetenceController');
    Route::resource('demandes', 'DemandeController');
    Route::resource('disponibilites', 'DisponibiliteController');
    Route::resource('employes', 'EmployeController');
    Route::resource('groupes', 'GroupeController');
    Route::resource('interventions', 'InterventionController');
    Route::resource('interventioneffectives', 'InterventioneffectiveController');
    Route::resource('juniors', 'JuniorController');
    Route::resource('rapports', 'RapportController');
    Route::resource('recurrences', 'RecurrenceController');
    Route::resource('regions', 'RegionController');
    Route::resource('seniors', 'SeniorController');
    Route::resource('employes', 'EmployeController');
});

Route::group(['prefix'=>'api','middleware'=>'auth'],function (){

    //////
});

Route::post('/auth/login', 'AuthController@login');
Route::get('/auth/logout', 'AuthController@logout');
