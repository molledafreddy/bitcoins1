<?php
/**
 * Batch Route Management
 **/

Route::get('payment-data', [
	'uses' => 'Admin\PaymentDataController@index',
	'as' => 'payment-data.index',
]);

Route::post('payment-data/store', [
	'uses' => 'Admin\PaymentDataController@store',
	'as' => 'payment-data.store',
]);
Route::post('payment-data/storeDetail/{id}', [
	'uses' => 'Admin\PaymentDataController@storeDetail',
	'as' => 'payment-data.store.detail',
]);

Route::put('payment-data/update/{id}', [
	'uses' => 'Admin\PaymentDataController@update',
	'as' => 'payment-data.update',
]);

Route::match(['get', 'post', 'put'], '/payment-data/{action}/{id?}', [
	'uses' => 'Admin\PaymentDataController@handler',
	'as' => 'payment-data.async',
]);

?>