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

Route::get('/', function () {
   return redirect()->route('pedido.index');
});

Route::get('/produto/get/{id?}', 'App\Http\Controllers\ProdutoController@get')->name('produto.get');
Route::resource('/produto',                                 'App\Http\Controllers\ProdutoController');
Route::resource('/pedido',                                  'App\Http\Controllers\PedidoController');
Route::resource('/cliente',                                 'App\Http\Controllers\ClienteController');


Route::post('/produto/delete', 'App\Http\Controllers\ProdutoController@delete')->name('produto.delete');
Route::post('/pedido/delete', 'App\Http\Controllers\PedidoController@delete')->name('pedido.delete');
Route::post('/cliente/delete', 'App\Http\Controllers\ClienteController@delete')->name('cliente.delete');

