@extends('plantilla.madre')
@section('titulo')
    Listado de promociones canceladas
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
        <th scope="col" class="sorting" style="text-align: center">Inicio de la promoción</th>
        <th scope="col" class="sorting" style="text-align: center">Final de la promoción</th>
            <th scope="col" class="sorting" style="text-align: center">Nombre del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Código del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Precio anterior</th>
            <th scope="col" class="sorting" style="text-align: center">Nuevo precio</th>
             <th scope="col" style="text-align: center">Ventas</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($promocion as $pro)
            <tr>
            <td style="text-align: center">{{\Carbon\Carbon::parse($pro->inicio)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
            <td style="text-align: center">{{\Carbon\Carbon::parse($pro->final)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td style="text-align: center">{{$pro->productos->nombre}}</td>
                <td style="text-align: center">{{$pro->productos->codigo}}</td>
                <td style="text-align: right">L.{{ number_format($pro->anterior,2)}}</td>
                <td style="text-align: right">L.{{ number_format($pro->nuevo,2)}}</td>
                <td>
                    <center>
                        <a class="btn btn-regresar" href="{{route("ventas.promociones",["id"=>$pro->id])}}">
                            <i class="fa-solid fa-box-open"></i>
                        </a>
                    </center>
                </td>

            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
