<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login','API\AuthController@login');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('test','API\AttendanceController@test');
    Route::post('attdance','API\AttendanceController@attend');
    Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
        Route::apiResource('member','API\AdminController');
        Route::post('configuration/{id}','API\ConfigurationController@update');
        Route::get('configuration/{id}','API\ConfigurationController@show');
        Route::post('member-edit/{id}','API\AdminController@edit');
        Route::post('check','API\AttendanceController@checkAll');
        Route::post('check/{id}','API\AttendanceController@check');
    });
    Route::group(['prefix' => 'superadmin','middleware' => 'superadmin'], function () {
        Route::apiResource('company','API\SuperAdminController');
        Route::post('company-edit/{id}','API\SuperAdminController@edit');
    });
});
