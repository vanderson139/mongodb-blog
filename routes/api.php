<?php

use App\Article;
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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::post('login', 'AuthController@login');

        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        Route::middleware('auth:api')->group(function () {
            Route::get('user', 'AuthController@user');
            Route::post('logout', 'AuthController@logout');
        });
    });

    Route::resource('article', 'Api\ArticleController')->middleware('auth:api');

    Route::get('/', function() {
        return Article::paginate(10);
    });

    Route::get('/{slug}', function($slug) {
        return Article::where('slug', $slug)->first();
    })->where('slug', '.*');
});
