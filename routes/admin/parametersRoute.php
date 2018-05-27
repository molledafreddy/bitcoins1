<?php
/**
 * Batch Route Management
 **/

Route::get('parameters', [
	'uses' => 'Admin\ParametersController@index',
	'as' => 'parameters.index',
]);

Route::post('parameters/store', [
	'uses' => 'Admin\ParametersController@store',
	'as' => 'parameters.store',
]);

Route::put('parameters/update/{id}', [
	'uses' => 'Admin\ParametersController@update',
	'as' => 'parameters.update',
]);

Route::match(['get', 'post', 'put'], '/parameters/{action}/{id?}', [
	'uses' => 'Admin\ParametersController@handler',
	'as' => 'parameters.async',
]);

?>