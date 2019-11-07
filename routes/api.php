<?php

Route::apiResource('questions', 'QuestionController');
Route::apiResource('questions/{question}/replies', 'ReplyController');
Route::apiResource('categories', 'CategoryController');

Route::apiResource('questions/{question}/replies/{reply}/likes', 'LikeController', ['except' => ['show', 'update']]);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
