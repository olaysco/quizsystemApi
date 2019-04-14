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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function(Request $request){
    return response()->json(["hello test"], 200,[]);
});

Route::group(['prefix' => 'v1','namespace'=>'v1'], function () {
    //this routes belongs to authenticated users
    Route::get('all_question','QuestionController@index');
    Route::get('question', 'QuestionController@getCategoryQuestion');
    Route::get('all_category', 'CategoryController@index');

    /**
     * This route group works
     * for v1/admin(authenticated admins) routes only
     * to prevent normal users from performing
     * admin roles
     */
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/add_question','QuestionController@store');
        Route::post('/add_category','CategoryController@store');
        Route::get('/add_question',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });
         Route::get('/add_category',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });
        Route::get('/',function(){
            return response()->json(true, 200, []);
        });
    });
});
