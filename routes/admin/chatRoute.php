<?php
/**
 * Batch Route Management
 **/

Route::get('admin/chats', [
	'uses' => 'Admin\ChatController@index',
	'as' => 'admin.chat.index',
]);

Route::post('chat/store', [
	'uses' => 'Admin\ChatController@store',
	'as' => 'admin.chat.store',
]);

Route::put('chat/update/{id}', [
	'uses' => 'Admin\ChatController@update',
	'as' => 'admin.chat.update',
]);

Route::match(['get', 'post', 'put'], '/chat/{action}/{id?}', [
	'uses' => 'Admin\ChatController@handler',
	'as' => 'admin.chat.async',
]);

?>