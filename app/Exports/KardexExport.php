<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use App\Models\Producto_vendido;
use App\Models\Producto_Comprado;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KardexExport implements FromView
{
    protected $productos;
    protected $oldproductos;
    public function __construct($compra=null, $compra2=null)
    {
        $this->productos=$compra;
        $this->oldproductos=$compra2;
    }
    public function view(): View {
        $productos=$this->productos;
        $oldproductos=$this->oldproductos;
        return view("kardex.excel",compact("productos","oldproductos"));
    }
    
}
