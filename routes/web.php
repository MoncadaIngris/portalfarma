<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
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


Route::get('/j', function () {
    return 'jorge';
});


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
