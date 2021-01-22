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
    return view('welcome');
});

//Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// trayendo los productos del gerente de la pagina
Route::get('/mis_articulos', [App\Http\Controllers\gerenteProductos::class, 'articulos_gerente'])->name('mostrar_datos');





// trayendo los productos por zona y su stock de esa zona
Route::post('/productos_zona', [App\Http\Controllers\gerenteProductos::class, 'productos_zona'])->name('productos_zona');

Route::post('/consulta', [App\Http\Controllers\gerenteProductos::class, 'buscar_productos'])->name('');
//Registro de productos
Route::post('/registro_productos', [App\Http\Controllers\gerenteProductos::class, 'registro_productos'])->name('registrar_articulos');

//actualizar
Route::patch('/actualizar_productos', [App\Http\Controllers\gerenteProductos::class, 'actualizar_productos'])->name('actualizar_articulos');

Route::post('/', [App\Http\Controllers\gerenteProductos::class, 'registro_productos'])->name('registrar_articulos');

Route::post('/compras', [App\Http\Controllers\gerenteProductos::class, 'comprar_articulos'])->name('');

// trayendo los datos de nuevo cuando se quita un articulo del carro de compras
Route::get('/recargar_articulos', [App\Http\Controllers\gerenteProductos::class, 'recargar_articulos'])->name('');
///ver carro compras
Route::get('/compras', [App\Http\Controllers\gerenteProductos::class, 'carro_compras'])->name('');
//quitar del carrito
Route::post('/quitar_carro', [App\Http\Controllers\gerenteProductos::class, 'quitar_articulo'])->name('');