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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'App\Http\Controllers\BlogController@register');
Route::post('login', 'App\Http\Controllers\BlogController@login');
Route::post('title', 'App\Http\Controllers\BlogController@title');
Route::post('comment/{blogid}', 'App\Http\Controllers\BlogController@comment');
Route::post('profile', 'App\Http\Controllers\BlogController@profile');