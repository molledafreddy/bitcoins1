<?php
/**
 * Batch Route Management
 **/


Route::get('admin/comments', [
	'uses' => 'Admin\CommentController@index',
	'as' => 'admin.comment.index',
]);

Route::post('comment/store', [
	'uses' => 'Admin\CommentController@store',
	'as' => 'admin.comment.store',
]);

Route::put('comment/update/{id}', [
	'uses' => 'Admin\CommentController@update',
	'as' => 'admin.comment.update',
]);

Route::match(['get','post','put'],'/comment/{action}/{id?}', [
	'uses' => 'Admin\CommentController@handler',
	'as' => 'admin.comment.async',
]);

?>