<?php

Route::get('/panel', [
	'uses' => 'User\HomeController@index',
	'as' => 'user.panel',
]);

Route::get('/dashboard', [
	'uses' => 'User\HomeController@dashboard',
	'as' => 'user.dashboard',
]);

Route::get('/transactions', [
	'uses' => 'User\UserTransactionsController@index',
	'as' => 'user.transactions',
]);

Route::get('/transaction-detail/{action}/{id?}', [
	'uses' => 'User\UserTransactionsController@detail',
	'as' => 'user.transaction.detail',
]);

Route::get('/settings', [
	'uses' => 'User\UserSettingsController@index',
	'as' => 'user.settings',
]);

Route::get('/edituser', [
	'uses' => 'User\UserSettingsController@edituser',
	'as' => 'user.edituser',
]);

Route::get('/editpassword', [
	'uses' => 'User\UserSettingsController@editpassword',
	'as' => 'user.editpassword',
]);

Route::post('/editedpassword', [
	'uses' => 'User\UserSettingsController@edit_password',
	'as' => 'user.password',
]);

Route::post('/editedaccount', [
	'uses' => 'User\UserSettingsController@edit_account',
	'as' => 'user.account',
]);

Route::get('/account_index', [
	'uses' => 'User\UserSettingsController@account_index',
	'as' => 'user.account_index',
]);

Route::get('/userpanel',[
	'uses'  =>  'User\HomeController@panel',
	'as'   =>  'panel',
]);

Route::match(['get', 'post', 'put'], '/user/{action}/{id?}', [
	'uses' => 'User\UserSettingsController@handler',
	'as' => 'user.async',
]);

Route::post('/comment', [
	'uses' => 'User\UserCommentController@store',
	'as' => 'comment.store',
]);

Route::post('/subscriptions',[
	'uses'  =>  'User\UserSubscriptionController@store',
	'as'   =>  	'subscriptions.store',
]);

Route::get('/crear_oferta',[
	'uses'        => 'Offers\OffersController@index',
	'as'          => 'offer.dashboard'
]);	

Route::match(['get', 'post', 'put'], '/offer/{action}/{id?}', [
	'uses' => 'Offers\OffersController@handler',
	'as' => 'offers.async',
]);

Route::get('buy_offer/{id}',[
	'uses'        => 'Offers\OffersController@buy_offer',
	'as'          => 'buy_offer'
]);

Route::post('buy_offer/{id}',[
	'uses'        => 'Offers\OffersController@buy_offer_pay',
	'as'          => 'buy_offer'
]);	

Route::get('sell_offer/{id}',[
	'uses'        => 'Offers\OffersController@sell_offer',
	'as'          => 'sell_offer'
]);

Route::post('sell_offer/{id}',[
	'uses'        => 'Offers\OffersController@sell_offer_pay',
	'as'          => 'sell_offer'
]);	

Route::get('/ofertas_de_compra',[
	'uses'  =>  'HomeController@buy_offers',
	'as'   =>  'user_buy_offers',
]);

Route::get('/ofertas_de_venta',[
	'uses'  =>  'HomeController@sell_offers',
	'as'   =>  'user_sell_offers',
]);

?>