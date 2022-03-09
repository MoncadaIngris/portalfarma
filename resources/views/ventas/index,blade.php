@extends('plantilla.madre')
@section('titulo')
    Listado de ventas
@stop
@section('contenido')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    
    <style>
        #prueba {
            overflow:auto;
        }
        .dt-buttons{
            float: right !important;
        }
      </style>
    <button class="btn btn-nuevo" onclick=""><i class="fa-solid fa-folder-plus"></i> Nueva venta</button>
    <div style="float: right;margin-right: 10px; width: 250px">
        <p><center>Descargar reporte:</center></p>
    </div>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Fecha efectuada</th>
            <th scope="col" style="text-align: center">Proveedor</th>
            <th scope="col" style="text-align: center">Sub Total</th>
            <th scope="col" style="text-align: center">Impuesto</th>
            <th scope="col" style="text-align: center">Total</th>
            <th scope="col" style="text-align: center">Detalle</th>

        
        
        </tr>
        </thead>
