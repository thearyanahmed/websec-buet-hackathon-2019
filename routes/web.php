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
Route::namespace('API')->middleware('throttle:5,1')->group(function(){
	Route::middleware('guest')->group(function(){
		Route::post('/new_account','Auth\\Register');
		Route::post('/login','Auth\\Login');
	});
	Route::middleware('auth.token')->group(function(){
		Route::post('/post/new','Post\\Store');
		Route::post('/post/{id}','Post\\Show');
		Route::patch('/post/{id}/update','Post\\Update');
		Route::post('/posts','Post\\Index');
		Route::patch('/post/{id}/approve','Post\\Approve');
		Route::delete('/post/{id}/delete','Post\\Delete');
		Route::post('/user/{id}/profile','User\\Profile');
		Route::patch('/user/{id}/profile/update','User\\Update');
		Route::delete('/user/{id}/delete','User\\Delete');
		Route::patch('/moderator/upgrade/{id}','User\\Upgrade');
		Route::patch('/moderator/downgrade/{id}','User\\Downgrade');
		
		Route::post('/logout','Auth\\Logout');
	});
});
