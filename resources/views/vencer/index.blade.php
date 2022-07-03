@extends('plantilla.madre')
@section('titulo')
    Listado de productos por vencer
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
      </style>
    
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Fecha de vencimiento</th>
            <th scope="col" class="sorting" style="text-align: center">Nombre del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Codigo del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Unidades</th>
           
        </tr>
        </thead>
        <tbody>
            
        @foreach ($vencer as $vence)
            <tr>
                <td>{{\Carbon\Carbon::parse($vence->vencimiento)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td>{{$vence->compras->productos->nombre}}</td>
                <td>{{$vence->compras->productos->codigo}}</td>
                <td>{{$vence->cantidad}}</td>
            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
