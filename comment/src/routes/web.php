<?php
$route = env('PACKAGE_ROUTE', '').'/comments/';
$controller = 'Increment\Common\Comment\Http\CommentController@';
//Comments
Route::post($route.'create', $controller."create");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'update', $controller."update");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

$route = env('PACKAGE_ROUTE', '').'/comment_replies/';
$controller = 'Increment\Common\Comment\Http\CommentReplyController@';
//Comment Replies
Route::post($route.'create',  $controller."create");
Route::post($route.'retrieve',  $controller."retrieve");
Route::post($route.'update',  $controller."update");
Route::post($route.'delete',  $controller."delete");
Route::get($route.'test',  $controller.'test');