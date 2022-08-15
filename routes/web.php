<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/susbcribe', 'NewsletterController@add')->name('newsletter.add');

Route::get('/dashboard', 'AdminController@index')->name('admin.index')->middleware(['auth','admin']);

Route::get('/pembelian', 'AdminController@pembelian')->name('admin.pembelian')->middleware(['auth','admin']);
Route::get('/pembelianBaru', 'AdminController@pembelianBaru')->name('admin.pembelianBaru')->middleware(['auth','admin']);
Route::get('/pembelian/{id}', 'AdminController@show_pembelian')->name('admin.showpembelian')->middleware(['auth','admin']);

Route::get('/laporan', 'AdminController@laporan')->name('admin.laporan')->middleware(['auth','admin']);
Route::post('/laporan/bulan', 'AdminController@laporanBulan')->name('laporanBulan')->middleware(['auth','admin']);
Route::post('/laporan/bulan/tahun', 'AdminController@laporanTahun')->name('laporanTahun')->middleware(['auth','admin']);
Route::get('/unduh-laporan/{bulan}/{tahun}', 'AdminController@laporanUnduh')->name('laporan.unduh')->middleware(['auth','admin']);

Route::get('/pembelian-acc/{id}', 'AdminController@pembelianAcc')->name('pembelian.acc')->middleware(['auth','admin']);
Route::get('/pembelian-del/{id}', 'AdminController@pembelianDel')->name('pembelian.del')->middleware(['auth','admin']);

Route::get('/user', 'AdminController@user')->name('admin.user')->middleware(['auth','admin']);
Route::get('/user/edit/{id}', 'AdminController@editUserform')->name('user.editform')->middleware(['auth','admin']);
Route::patch('/user/edit/{id}', 'AdminController@editUser')->name('user.edit')->middleware(['auth','admin']);
Route::get('/user/remove/{id}', 'AdminController@removeUser')->name('user.remove')->middleware(['auth','admin']);

Route::get('/admin-produk', 'ProdukController@list')->name('admin.produk')->middleware(['auth','admin']);
Route::get('/admin-produk/add', 'ProdukController@form')->name('admin.addform')->middleware(['auth','admin']);
Route::post('/admin-produk/add', 'ProdukController@create')->name('produk.create')->middleware(['auth','admin']);
Route::get('/admin-produk/edit/{id}', 'ProdukController@editform')->name('produk.editform')->middleware(['auth','admin']);
Route::patch('/admin-produk/edit/{id}', 'ProdukController@edit')->name('produk.edit')->middleware(['auth','admin']);
Route::get('/admin-produk/remove/{id}', 'ProdukController@remove')->name('produk.remove')->middleware(['auth','admin']);

Route::get('/admin-stock', 'StockController@index')->name('admin.stock')->middleware(['auth','admin']);
Route::get('/admin-stock/show', 'StockController@show')->name('admin.stockshow')->middleware(['auth','admin']);
Route::get('/admin-stock/remove/{id}', 'StockController@remove')->name('admin.removestock')->middleware(['auth','admin']);
Route::get('/admin-stock/edit/{id}', 'StockController@editform')->name('admin.editform')->middleware(['auth','admin']);
Route::patch('/admin-stock/edit/{id}', 'StockController@editstock')->name('admin.editstock')->middleware(['auth','admin']);

Route::get('/admin-stock/add', 'StockController@addform')->name('admin.addstockform')->middleware(['auth','admin']);
Route::post('/admin-stock/add', 'StockController@addstock')->name('admin.addstock')->middleware(['auth','admin']);

Route::get('/produk','ProdukController@index')->name('produk.index');
Route::get('/produk/filter','ProdukController@filter')->name('produk.filter');

Route::get('/produk/{produk}','ProdukController@show')->name('produk.show');

Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/add/{produk}','CartController@add')->name('cart.add');
Route::get('/cart/remove/{id}','CartController@remove')->name('cart.remove');
Route::get('/cart/plus/{id}','CartController@plus')->name('cart.plus');
Route::get('/cart/min/{id}','CartController@min')->name('cart.min');

Route::get('/checkout','CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout','CheckoutController@checkout')->name('checkout')->middleware('auth');
Route::post('/checkout/city','CheckoutController@city')->name('city')->middleware('auth');

Route::get('/user/pembelian','PembelianController@show')->name('pembelian.show')->middleware('auth');
Route::get('/user/pembelian/upload/{id}','PembelianController@uploadBukti')->name('pembelian.upload')->middleware('auth');
Route::post('/user/pembelian/upload/','PembelianController@uploadBuktiProcess')->name('pembelian.uploadProcess')->middleware('auth');

Route::get('/user/pembelian/ulasan/{id}','BeriNilaiController@show')->name('ulasan.show')->middleware('auth');
Route::post('/user/pembelian/ulasan/','BeriNilaiController@ulasan')->name('ulasan.ulasan')->middleware('auth');

Route::get('/profile/{user}/edit','UserController@edit')->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}','UserController@update')->name('profile.update')->middleware('auth');

Auth::routes();