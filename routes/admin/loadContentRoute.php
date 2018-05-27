<?php
/**
 * Batch Route Management
 **/

Route::get('load-content', [
	'uses' => 'Admin\LoadContentController@index',
	'as' => 'load-contents.index',
]);

Route::post('load-content/store', [
	'uses' => 'Admin\LoadContentController@store',
	'as' => 'load-contents.store',
]);

Route::put('load-content/update/{id}', [
	'uses' => 'Admin\LoadContentController@update',
	'as' => 'load-contents.update',
]);

Route::match(['get', 'post', 'put'], '/load-content/{action}/{id?}', [
	'uses' => 'Admin\LoadContentController@handler',
	'as' => 'load-contents.async',
]);

?>