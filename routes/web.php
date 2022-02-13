<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProveedorController;
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

Route::put("/empleados/{id}/edit", [EmpleadoController::class, "update"])
    ->name("empleado.edit")->where('id', '[0-9]+');

Route::get("/empleados/{id}", [EmpleadoController::class, "show"])
    ->name("empleado.show")->where('id', '[0-9]+');

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
