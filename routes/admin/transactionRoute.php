<?php
/**
 * Batch Route Management
 **/

Route::get('transaction-verification', [
	'uses' => 'Admin\TransactionVerificationController@index',
	'as' => 'transaction-verification.index',
]);

Route::get('transaction-search', [
	'uses' => 'Admin\TransactionVerificationController@search',
	'as' => 'transaction.search',
]);

Route::post('transaction-verification/store', [
	'uses' => 'Admin\TransactionVerificationController@store',
	'as' => 'transaction-verification.store',
]);

Route::put('transaction-verification/update/{id}', [
	'uses' => 'Admin\TransactionVerificationController@update',
	'as' => 'transaction-verification.update',
]);

Route::match(['get', 'post', 'put'], '/transaction-verification/{action}/{id?}', [
	'uses' => 'Admin\TransactionVerificationController@handler',
	'as' => 'transaction-verification.async',
]);

?>