<?php
/**
 * Batch Route Management
 **/

Route::get('account-types', [
	'uses' => 'Admin\AccountTypeController@index',
	'as' => 'account-type.index',
]);

Route::post('account-types/store', [
	'uses' => 'Admin\AccountTypeController@store',
	'as' => 'account-types.store',
]);

Route::post('account-types/update/{id}', [
	'uses' => 'Admin\AccountTypeController@update',
	'as' => 'account-types.update',
]);

Route::get('account-types/editar/{id}', [
	'uses' => 'Admin\AccountTypeController@editar',
	'as' => 'account-types.editar',
]);

Route::match(['get', 'post', 'put'], '/account-types/{action}/{id?}', [
	'uses' => 'Admin\AccountTypeController@handler',
	'as' => 'account-types.async',
]);

?>