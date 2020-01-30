<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\LoginController@index');

// measures
Route::group(['prefix' => 'measures'], function () {
    Route::get('/', 'Api\MeasureController@index');
    Route::get('/{id}', 'Api\MeasureController@show');
    Route::put('/{id}', 'Api\MeasureController@update');
    Route::delete('/{id}', 'Api\MeasureController@destroy');
    Route::post('/', 'Api\MeasureController@store');
});

// cardsEquipaments
Route::group(['prefix' => 'cardsEquipaments'], function () {
    Route::get('/', 'Api\CardEquipamentController@index');
    Route::get('/create', 'Api\CardEquipamentController@create');
    Route::get('/{idCard}/{idEquipament?}', 'Api\CardEquipamentController@show');
    Route::put('/{idCard}/{idEquipament?}', 'Api\CardEquipamentController@update');
    Route::delete('/{idCard}/{idEquipament}', 'Api\CardEquipamentController@destroy');
    Route::post('/', 'Api\CardEquipamentController@store');
});

// cards
Route::group(['prefix' => 'cards'], function () {
    Route::get('/', 'Api\CardController@index');
    Route::get('/create', 'Api\CardController@create');
    Route::get('/{id}', 'Api\CardController@show');
    Route::put('/{id}', 'Api\CardController@update');
    Route::delete('/{id}', 'Api\CardController@destroy');
    Route::post('/', 'Api\CardController@store');
});

// heatings
Route::group(['prefix' => 'heatings'], function () {
    Route::get('/', 'Api\HeatingController@index');
    Route::get('/{id}', 'Api\HeatingController@show');
    Route::put('/{id}', 'Api\HeatingController@update');
    Route::delete('/{id}', 'Api\HeatingController@destroy');
    Route::post('/', 'Api\HeatingController@store');
});

// goals
Route::group(['prefix' => 'goals'], function () {
    Route::get('/', 'Api\GoalController@index');
    Route::get('/{id}', 'Api\GoalController@show');
    Route::put('/{id}', 'Api\GoalController@update');
    Route::delete('/{id}', 'Api\GoalController@destroy');
    Route::post('/', 'Api\GoalController@store');
});

// academys
Route::group(['prefix' => 'academys'], function () {
    Route::get('/', 'Api\AcademyController@index');
    Route::get('/{id}', 'Api\AcademyController@show');
    Route::put('/{id}', 'Api\AcademyController@update');
    Route::delete('/{id}', 'Api\AcademyController@destroy');
    Route::post('/', 'Api\AcademyController@store');
});

// users
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\UserController@index');
    Route::get('/create', 'Api\UserController@create');
    Route::get('/{id}', 'Api\UserController@show');
    Route::put('/{id}', 'Api\UserController@update');
    Route::delete('/{id}', 'Api\UserController@destroy');
    Route::post('/', 'Api\UserController@store');
});

// equipamets
Route::group(['prefix' => 'equipaments'], function () {
    Route::get('/', 'Api\EquipamentController@index');
    Route::get('/{id}', 'Api\EquipamentController@show');
    Route::put('/{id}', 'Api\EquipamentController@update');
    Route::delete('/{id}', 'Api\EquipamentController@destroy');
    Route::post('/', 'Api\EquipamentController@store');
});

// groups
Route::group(['prefix' => 'groups'], function () {
    Route::get('/', 'Api\GroupController@index');
    Route::get('/{id}', 'Api\GroupController@show');
    Route::put('/{id}', 'Api\GroupController@update');
    Route::delete('/{id}', 'Api\GroupController@destroy');
    Route::post('/', 'Api\GroupController@store');
});
