<?php
/**
 * Batch Route Management
 **/

Route::get('account', [
	'uses' => 'Admin\AccountController@index',
	'as' => 'accounts.index',
]);

Route::post('account/store', [
	'uses' => 'Admin\AccountController@store',
	'as' => 'accounts.store',
]);

Route::put('account/update/{id}', [
	'uses' => 'Admin\AccountController@update',
	'as' => 'accounts.update',
]);

Route::match(['get', 'post', 'put'], '/account/{action}/{id?}', [
	'uses' => 'Admin\AccountController@handler',
	'as' => 'accounts.async',
]);

?>