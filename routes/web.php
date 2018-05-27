<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
	'uses'  =>  'HomeController@index',
	'as'   =>  'siteHome',
]);

Route::view('/prueba', 'email.emailContactoAdmin');


Route::get('/home', function(){
	event(
		new \App\Events\TestEvent()
	);
});
Route::get('/home/chat',[
	'uses'  =>  'HomeController@home',
	'as'   =>  'home',
]);

Route::get('/ofertas_de_compra',[
	'uses'  =>  'HomeController@buy_offers',
	'as'   =>  'buy_offers',
]);

Route::get('/ofertas_de_venta',[
	'uses'  =>  'HomeController@sell_offers',
	'as'   =>  'sell_offers',
]);

Route::get('/compras',[
	'uses'  =>  'HomeController@buys',
	'as'   =>  'buys',
]);

Route::get('/ventas',[
	'uses'  =>  'HomeController@sells',
	'as'   =>  'sells',
]);

Route::get('/Nosotros',[
	'uses'  =>  'HomeController@about_us',
	'as'   =>  'about_us',
]);

Route::get('/contacto',[
	'uses'  =>  'HomeController@contact',
	'as'   =>  'contact',
]);

Route::post('/contact/store',[
	'uses'  =>  'HomeController@contactStore',
	'as'   =>  'contact.store',
]);

Route::get('/servicios',[
	'uses'  =>  'HomeController@services',
	'as'   =>  'services',
]);

Route::get('/comentarios',[
	'uses'  =>  'HomeController@comments',
	'as'   =>  'comments',
]);

Route::get('/load_home_content/{id}',[
	'uses'  =>  'HomeController@load_home_content',
	'as'   =>  'load_home_content',
]);

Route::get('/message',[
	'uses'  =>  'User\UserChatController@listChat',
	'as'   =>  'message',
]);

Route::post('/message/store',[
	'uses'  =>  'User\UserChatController@store',
	'as'   =>  'message.store',
]);

Route::get('/message/room',[
	'uses'  =>  'User\UserChatController@room',
	'as'   =>  'message.room',
]);

Route::get('busqueda',[
	'uses'  =>  'HomeController@search',
	'as'   =>  'search',
]);

Auth::routes();

Route::get('/recuperacion_de_contraseña', [
	'uses' => 'Auth\ForgotPasswordController@index',
	'as' => 'auth.forgetpassword',
]);

Route::post('/email_contraseña', [
	'uses' => 'Auth\ForgotPasswordController@recover_pass',
	'as' => 'recuperar.password',
]);

Route::get('/cambio_contraseña/{token}', [
	'uses' => 'Auth\ResetPasswordController@view_reset',
	'as' => 'change.password',
]);

Route::post('/contraseña_cambiada', [
	'uses' => 'Auth\ResetPasswordController@reset_pass',
	'as' => 'resetear.password',
]);


Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');




Route::group(['prefix' => 'administracion', 'middleware' => '2fa'], function(){
	require __DIR__ . '/admin.php';
});

Route::group(['prefix' => 'usuario', 'middleware' => '2fa'], function(){
	require __DIR__ . '/user.php';
});

//logout
Route::get('/salida', ['uses' => 'HomeController@salida', 'as' => 'salida']);

//after scan QR code
Route::get('/completar_registro', 'Auth\RegisterController@completeRegistration')->name('completar');

Route::get('/renovar_registro',[
	'uses'  =>  'HomeController@renewRegistration',
	'as'   =>  'renew_reg',
]);

Route::post('/2fa', function () {

    if (Auth::user()->type == 'A'){
    		request()->session()->put('key', 1);
			return redirect()->route("admin.index");

        } else if (Auth::user()->type == 'U'){
        	request()->session()->put('key', 1);
			return redirect()->route("user.panel");
		}
})->name('2fa')->middleware('2fa');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
