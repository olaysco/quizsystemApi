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
Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace'=>'v1'], function () {
    //this routes belongs to authenticated users
    Route::get('question/all','QuestionController@index');
    Route::get('question', 'QuestionController@getCategoryQuestion');
    Route::get('category/all', 'CategoryController@index');
    Route::post('evaluate', 'AnswersController@evaluate');

    /**
     * This route group works
     * for v1/admin(authenticated admins) routes only
     * to prevent normal users from performing
     * admin roles
     */
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/question/add','QuestionController@store');
        Route::post('/category/add','CategoryController@store');
        Route::get('/category/question/{category}','CategoryController@categoryQuestions');
        Route::get('/question/add',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });
         Route::get('/category/add',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });
         Route::post('/category/edit/{category}','CategoryController@update');
         Route::get('/category/edit',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });
         Route::post('/question/edit/{question}','QuestionController@update');
         Route::get('/question/edit',function(){ 
            return response()->json(["message"=>"invalid"], 403, []);
         });


    });
    

});

Route::fallback(function(){
    return response()->json(["message"=>"invalid request"], 404, []);
});
Route::fallback(function(Request $request){
    return response()->json(["message"=>"invalid request"], 404, []);
});
