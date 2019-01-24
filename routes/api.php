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

Route::namespace('API')->group(function(){
	Route::post('/create_new','Auth\\Register');

	Route::middleware('auth.token')->group(function(){

		Route::post('logout','Auth\\Logout');

		Route::post('/test',function(){
			$user = auth()->user();
			$data['user'] = $user;
			$data['message'] = 'mew';
			return response()->json($data,200);
		});
	});
});