<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/','HomeController@ShowIklan');
    Route::get('search','HomeController@search');
    Route::get('lihatbarang','HomeController@lihatbarang');
    Route::get('iklan_detail/{id}','HomeController@ShowDetailIklan');

    Route::get('notif/total','UserController@getTotalNotif');
    Route::get('notification','UserController@showNotif');
    Route::get('register','UserController@ShowRegisterForm');
    Route::post('daftar','UserController@daftar');
    Route::get('daftar','UserController@daftar');
    Route::get('masuk','UserController@loginform');
    Route::post('login','UserController@login');
    Route::get('login','UserController@login');
    Route::get('logout','UserController@logout');
    Route::post('editproses','UserController@UpdateAccount');
    Route::get('editproses','UserController@UpdateAccount');
    Route::get('lihatakun','UserController@lihatakun');
    Route::get('editakun','UserController@editakun');

    Route::get('testimoni/{id}','BuyerController@ShowTestimoniForm');
    Route::post('testimoniproses','BuyerController@AddTestimoni');
    Route::get('testimoniproses','BuyerController@AddTestimoni');
    Route::get('penjual/{id}','BuyerController@ShowPenjual');
    Route::post('transaksi','BuyerController@transaksi');
    Route::get('transaksi','BuyerController@transaksi');
    Route::get('transaksibeli','BuyerController@transaksibeli');
    Route::get('batal/{id}','BuyerController@batal');

	Route::get('tambahbarang','SellerController@tambahbarang');
	Route::post('tambahbarangproses','SellerController@tambahbarangproses');
    Route::get('tambahbarangproses','SellerController@tambahbarangproses');
    Route::get('editbarang/{id}','SellerController@editbarang');
    Route::post('editbarangproses','SellerController@editbarangproses');
    Route::get('editbarangproses','SellerController@editbarangproses');
    Route::get('transaksijual','SellerController@transaksijual');
    Route::get('konfirmasi/{id}','SellerController@konfirmasi');
    Route::get('hapusbarang/{id}','SellerController@hapusbarang');





});
