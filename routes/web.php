<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\ProductoVendidoController;
use App\Http\Controllers\PermisoController;
use Illuminate\Support\Facades\Auth;

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
// Cambiar idioma. En este caso "en":

//rutas para login
Auth::routes();

Route::middleware("auth")->group(function () {

Route::get('/', function () {
    return view('welcome');
});

//ruta index
Route::get('/empleados', [EmpleadoController::class, 'index'])
    ->name('empleados.index');
//ruta  create
Route::get('/empleados/nuevo',[EmpleadoController::class, 'create'])
    ->name('empleados.create');
//ruta guardar
Route::post('/empleados/nuevo',[EmpleadoController::class, 'store'])
    ->name('empleados.store');

Route::get("/empleados/{id}/edit", [EmpleadoController::class, "edit"])
    ->name("empleado.edit")->where('id', '[0-9]+');

 //ruta editar
Route::put("/empleados/{id}/edit", [EmpleadoController::class, "update"])
    ->name("empleado.edit")->where('id', '[0-9]+');
 //ruta detalle
Route::get("/empleados/{id}", [EmpleadoController::class, "show"])
    ->name("empleado.show")->where('id', '[0-9]+');

//ruta desactivar
Route::get('/empleados/{id}/desactivado', [EmpleadoController::class, 'desactivar'])
    ->name('empleados.desactivar')->where('id', '[0-9]+');

//ruta lista desactivados
Route::get('/empleados/desactivados', [EmpleadoController::class, 'desactivados'])
    ->name('empleados.desactivado');

//ruta activar empleados
Route::get('/empleados/{id}/activar', [EmpleadoController::class, 'activar'])
    ->name('empleados.activar')->where('id', '[0-9]+');


//ruta  create
Route::get('/proveedor/nuevo',[ProveedorController::class, 'create'])
->name('proveedor.create');
//ruta guardar
Route::post('/proveedor/nuevo',[ProveedorController::class, 'store'])
->name('proveedor.store');

//ruta  create
Route::get('/proveedor/nuevo/{prov?}',[ProveedorController::class, 'create'])
->name('proveedor.create2')->where('prov', '[0-9]+');
//ruta guardar
Route::post('/proveedor/nuevo/{prov?}',[ProveedorController::class, 'store'])
->name('proveedor.store2')->where('prov', '[0-9]+');


//Ruta Formulario proveedor
Route::get('/proveedor', [ProveedorController::class, 'index'])
->name('proveedor.index');

//Ruta editar proveedor
Route::get("/proveedor/{id}/edit", [ProveedorController::class, "edit"])
    ->name("proveedor.edit")->where('id', '[0-9]+');

Route::put("/proveedor/{id}/edit", [ProveedorController::class, "update"])
    ->name("proveedor.edit")->where('id', '[0-9]+');

    //Ruta detalle proveedor
Route::get("/proveedor/{id}", [ProveedorController::class, "show"])
    ->name("proveedor.show")->where('id', '[0-9]+');

    //ruta lista desactivados de proveedor
Route::get('/proveedor/desactivados', [ProveedorController::class, 'desactivados'])
->name('proveedor.desactivado');

//ruta activar proveedor
Route::get('/proveedor/{id}/activar', [ProveedorController::class, 'activar'])
    ->name('proveedor.activar')->where('id', '[0-9]+');

// Ruta desactivar proveedor
    Route::get('/proveedor/{id}/desactivado', [ProveedorController::class, 'desactivar'])
    ->name('proveedor.desactivar')->where('id', '[0-9]+');



    //ruta index productos
Route::get('/productos', [ProductoController::class, 'index'])
->name('productos.index');

//ruta  create
Route::get('/productos/nuevo',[ProductoController::class, 'create'])
->name('productos.create');

//ruta guardar
Route::post('/productos/nuevo',[ProductoController::class, 'store'])
    ->name('productos.store');

    Route::get("/productos/{id}", [ProductoController::class, "show"])
    ->name("productos.show")->where('id', '[0-9]+');

    //compras
//ruta  create
Route::get('/compra/nuevo/{proveedor?}',[compraController::class, 'create'])
->name('compras.create')->where('proveedor', '[0-9]+');
//ruta guardar
Route::post('/compra/nuevo/{proveedor?}',[CompraController::class, 'store'])
->name('compras.store')->where('proveedor', '[0-9]+');

//ruta guardar
Route::put('/compra/guardar/{proveedor}',[CompraController::class, 'save'])
->name('compras.save')->where('proveedor', '[0-9]+');

//ruta limpiar
Route::put('/compra/limpiar/{proveedor}',[CompraController::class, 'limpiar'])
->name('compras.limpiar')->where('proveedor', '[0-9]+');

//ruta cancelar
Route::put('/compra/cancelar',[CompraController::class, 'cancelar'])
->name('compras.cancelar');

//ruta borrar
Route::delete('/compra/{id}/limpiar/{proveedor}',[CompraController::class, 'eliminar'])
->name('compras.borrar')->where('proveedor', '[0-9]+')->where('id', '[0-9]+');

//ruta  create
Route::get('/productos/nuevo/{prov?}',[ProductoController::class, 'create'])
->name('productos.create2');

//ruta guardar
Route::post('/productos/nuevo/{prov?}',[ProductoController::class, 'store'])
    ->name('productos.store2');

    //ruta editar producto
Route::get("/productos/{id}/edit", [ProductoController::class, "edit"])->where('id', '[0-9]+');

Route::put("/productos/{id}/edit", [ProductoController::class, "update"])
->name("productos.edit")->where('id', '[0-9]+');

//ruta index
Route::get('/compras', [CompraController::class, 'index'])
    ->name('compras.index');

    //ruta index
Route::get('/compras/{id}', [CompraController::class, 'show'])
->name('compras.show')->where('id', '[0-9]+');

//ruta index
Route::get('/inventario', [InventarioController::class, 'index'])
    ->name('inventario');

    Route::get('/inventario/{id}', [InventarioController::class, 'show'])
    ->name('inventario.show')->where('id', '[0-9]+');;

Route::get('/compras/pdf', [CompraController::class, 'createPDF'])->name('compra.pdf');

Route::get('/inventario/pdf', [InventarioController::class, 'createPDF'])->name('inventario.pdf');


//ruta index
Route::get('/clientes', [ClienteController::class, 'index'])
    ->name('clientes.index');
//ruta  create
Route::get('/clientes/nuevo',[ClienteController::class, 'create'])
    ->name('clientes.create');
//ruta guardar
Route::post('/clientes/nuevo',[ClienteController::class, 'store'])
    ->name('clientes.store');

//ruta editar clientes
Route::get("/clientes/{id}/edit", [ClienteController::class, "edit"])
->name("clientes.edit")->where('id', '[0-9]+');

 Route::put("/clientes/{id}/edit", [ClienteController::class, "update"])
->name("clientes.edit")->where('id', '[0-9]+');

Route::get('/clientes/{id}', [ClienteController::class, 'show'])
->name('clientes.show')->where('id', '[0-9]+');;



//Ventas
//ruta  create
Route::get('/cliente/nuevo/{clie?}',[ClienteController::class, 'create'])
->name('cliente.create2')->where('clie', '[0-9]+');
//ruta guardar
Route::post('/cliente/nuevo/{clie?}',[ClienteController::class, 'store'])
->name('cliente.store2')->where('clie', '[0-9]+');




//ruta  create
Route::get('/venta/nuevo/{cliente?}',[VentaController::class, 'create'])
->name('ventas.create')->where('proveedor', '[0-9]+');
//ruta guardar
Route::post('/venta/nuevo/{cliente?}',[VentaController::class, 'store'])
->name('ventas.store')->where('proveedor', '[0-9]+');

//ruta guardar
Route::put('/venta/guardar/{cliente}',[VentaController::class, 'save'])
->name('ventas.save')->where('cliente', '[0-9]+');

//ruta limpiar
Route::put('/venta/limpiar/{cliente}',[VentaController::class, 'limpiar'])
->name('ventas.limpiar')->where('proveedor', '[0-9]+');

//ruta cancelar
Route::put('/venta/cancelar',[VentaController::class, 'cancelar'])
->name('ventas.cancelar');

//ruta borrar
Route::delete('/venta/{id}/limpiar/{cliente}',[VentaController::class, 'eliminar'])
->name('ventas.borrar')->where('cliente', '[0-9]+')->where('id', '[0-9]+');

//ruta index ventas
Route::get('/ventas', [VentaController::class, 'index'])
    ->name('ventas.index');

    //ruta index
Route::get('/ventas/{id}', [VentaController::class, 'show'])
->name('ventas.show')->where('id', '[0-9]+');

Route::get('/ventas/pdf', [VentaController::class, 'createPDF'])->name('venta.pdf');

Route::get('/show-ventas/pdf', [VentaController::class, 'createPDF'])->name('venta.pdf');

Route::get('/kardex', [KardexController::class, 'index'])
    ->name('kardex');

Route::get('/kardex/pdf', [KardexController::class, 'createPDF'])->name('kardex.pdf');
Route::get('/kardex/xlsx', [KardexController::class, 'exportxlsx'])->name('kardex.xlsx');
Route::get('/kardex/csv', [KardexController::class, 'exportcsv'])->name('kardex.csv');

// rutas para Graficos

Route::get('graficos/graficoProducto/{val}',[GraficoController::class,'producto'])
->name('grafico.producto');

Route::get('graficos/graficoProveedor/{val}',[GraficoController::class,'proveedor'])
->name('grafico.proveedor');

Route:: get('graficos',[ProductoVendidoController::class,'index'])
->name('grafico.index');


Route:: get('graficos/ventas',[VentaController::class,'grafico'])
->name('grafico.ventas');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registrar', [UserController::class, 'showRegistrationForm'])->name('registrar');

Route::post('/registrar', [UserController::class, 'create']);



//rutas permisos
Route::get('/permisos/nuevo',[PermisoController::class, 'create'])
->name('permisos.create');
Route::post('/permisos/nuevo',[PermisoController::class, 'store'])
    ->name('permisos.store');



//ruta lista permisos
Route::get('/permisos', [PermisoController::class, 'index'])
    ->name('permisos.index');

    //ruta guardar
    Route::post('/permisos/nuevo',[PermisoController::class, 'store'])
    ->name('permisos.store');
});







