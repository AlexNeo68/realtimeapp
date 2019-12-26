<?php

Route::apiResource('questions', 'QuestionController');
Route::apiResource('questions/{question}/replies', 'ReplyController');
Route::apiResource('categories', 'CategoryController');


Route::post('replies/{reply}/like', 'LikeController@like');
Route::delete('replies/{reply}/unlike', 'LikeController@unlike');

Route::get('readnotifications', 'Notification\NotificationController@readnotifications');
Route::get('unreadnotifications', 'Notification\NotificationController@unreadnotifications');
Route::post('markasread', 'Notification\NotificationController@markasread');

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
