<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empleados = Empleado::all()->count();
        $proveedores = Proveedor::all()->count();
        $clientes = Cliente::all()->count();
        $productos = Producto::all()->count();

        return view('welcome')
            ->with("empleados", $empleados)
            ->with("proveedores", $proveedores)
            ->with("clientes", $clientes)
            ->with("productos", $productos);
    }
}
