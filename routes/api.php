<?php

Route::apiResource('questions', 'QuestionController');
Route::apiResource('questions/{question}/replies', 'ReplyController');
Route::apiResource('categories', 'CategoryController');

Route::apiResource('questions/{question}/replies/{reply}/likes', 'LikeController', ['except' => ['show', 'update']]);
