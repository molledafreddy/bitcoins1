<?php

Route::get('/panel', [
	'uses' => 'Admin\HomeController@index',
	'as' => 'admin.index',
]);

Route::get('/usuarios', [
	'uses' => 'Admin\UsersController@index',
	'as' => 'admin.users.index',
]);

Route::match(['get', 'post', 'put'], '/usuarios/{action}/{id?}', [
	'uses' => 'Admin\UsersController@handler',
	'as' => 'admin.users.async',
]);

Route::get('/getDataTablesUser/{type}', [
	'uses' => 'Admin\UsersController@getDataTables',
	'as' => 'admin.users.datatables',
]);

require __DIR__ . '/admin/loadContentRoute.php';
require __DIR__ . '/admin/parametersRoute.php';
require __DIR__ . '/admin/paymentDataRoute.php';
require __DIR__ . '/admin/commentRoute.php';
require __DIR__ . '/admin/transactionRoute.php';
require __DIR__ . '/admin/chatRoute.php';
require __DIR__ . '/admin/AccountTypeRoute.php';
require __DIR__ . '/admin/AccountRoute.php';