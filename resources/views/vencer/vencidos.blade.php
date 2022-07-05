@extends('plantilla.madre')
@section('titulo')
    Listado de productos vencidos
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
    
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Fecha de vencimiento</th>
            <th scope="col" class="sorting" style="text-align: center">Nombre del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Código del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Unidades</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($vencer as $vence)
            <tr>
                <td style="text-align: center">{{\Carbon\Carbon::parse($vence->vencimiento)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td style="text-align: center">{{$vence->compras->productos->nombre}}</td>
                <td style="text-align: center">{{$vence->compras->productos->codigo}}</td>
                <td style="text-align: right">{{$vence->cantidad}}</td>
            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
