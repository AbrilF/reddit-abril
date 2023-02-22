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

//CRUD sobre un Post
Route::get('/posts', 'App\Http\Controllers\PostController@index');
Route::post('/posts', 'App\Http\Controllers\PostController@store');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show');
Route::put('/posts/{post}', 'App\Http\Controllers\PostController@update');
Route::delete('/posts/{post}', 'App\Http\Controllers\PostController@destroy');

//CRUD sobre un Comment
Route::get('/comments', 'App\Http\Controllers\CommentController@index');
Route::post('/comments', 'App\Http\Controllers\CommentController@store');
Route::get('/comments/{comment}', 'App\Http\Controllers\CommentController@show');
Route::put('/comments/{comment}', 'App\Http\Controllers\CommentController@update');
Route::delete('/comments/{comment}', 'App\Http\Controllers\CommentController@destroy');

//CRUD sobre una Community
Route::get('/communities', 'App\Http\Controllers\CommunityController@index');
Route::post('/communities', 'App\Http\Controllers\CommunityController@store');
Route::get('/communities/{community}', 'App\Http\Controllers\CommunityController@show');
Route::put('/communities/{community}', 'App\Http\Controllers\CommunityController@update');
Route::delete('/communities/{community}', 'App\Http\Controllers\CommunityController@destroy');

//CRUD relaciones con posts
Route::get('/posts/{post}/comments', 'App\Http\Controllers\PostController@comments');
Route::get('/communities/{community}/posts', 'App\Http\Controllers\CommunityController@posts');
Route::get('/posts/{post}/community', 'App\Http\Controllers\PostController@community');
Route::get('/comments/{comment}/post', 'App\Http\Controllers\CommentController@post');

//CRUD relaciones con users
Route::get('/users/{user}/posts', 'App\Http\Controllers\UserController@posts');
Route::get('/users/{user}/comments', 'App\Http\Controllers\UserController@comments');
Route::get('/users/{user}/communities', 'App\Http\Controllers\UserController@communities');
Route::get('/communities/{community}/users', 'App\Http\Controllers\CommunityController@users');

//Assign token
Route::post('/users/{user}/token', 'App\Http\Controllers\ApiTokenController@assignToken');
Route::get('/posts/{posts}/token', 'App\Http\Controllers\ApiTokenController@assignToken');
Route::get('/comments/{comments}/token', 'App\Http\Controllers\ApiTokenController@assignToken');
Route::get('/communities/{communities}/token', 'App\Http\Controllers\ApiTokenController@assignToken');
