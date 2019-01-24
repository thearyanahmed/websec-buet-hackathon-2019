<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('API')->middleware('throttle:15,5')->group(function(){

	Route::middleware('guest')->group(function(){
		Route::post('/new_account','Auth\\Register');
		Route::post('/login','Auth\\Login');
	});

	Route::middleware('auth.token')->group(function(){

		Route::post('/post/new','Post\\Store');
		Route::post('/post/{id}','Post\\Show');
		Route::patch('/post/{id}/update','Post\\Update');
		Route::post('/posts','Post\\Index');
		Route::post('logout','Auth\\Logout');

		Route::post('/test',function(){
			$user = auth()->user();
			$data['user'] = $user;
			$data['message'] = 'mew';
			return response()->json($data,200);
		});
	});
});