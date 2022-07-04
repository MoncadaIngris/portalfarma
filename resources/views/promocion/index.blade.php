@extends('plantilla.madre')
@section('titulo')
    Listado de Promociones
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
            <th scope="col" class="sorting" style="text-align: center">Nombre del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Código del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Precio anterior</th>
            <th scope="col" class="sorting" style="text-align: center">Nuevo precio</th>
             <th scope="col" style="text-align: center">Accion</th>
             <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Detalles</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($promocion as $pro)
            <tr>
                <td style="text-align: center">{{$pro->productos->nombre}}</td>
                <td style="text-align: center">{{$pro->productos->codigo}}</td>
                <td style="text-align: right">L.{{ number_format($pro->anterior,2)}}</td>
                <td style="text-align: right">L.{{ number_format($pro->nuevo,2)}}</td>
                <td>
                </td>
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("promociones.edit",["id"=>$pro->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
            
                    <td>
                        <center>
                <a class="btn btn-detalles" href="{{route("promociones.show",["id"=>$pro->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                        </center>
                    </td>

            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
