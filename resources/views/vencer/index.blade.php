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
            <th scope="col" style="text-align: center">Acción</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($vencer as $vence)
            <tr>
                <td style="text-align: center">{{\Carbon\Carbon::parse($vence->vencimiento)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td style="text-align: center">{{$vence->compras->productos->nombre}}</td>
                <td style="text-align: center">{{$vence->compras->productos->codigo}}</td>
                <td style="text-align: right">{{$vence->cantidad}}</td>
                <td>
                    <?php $n=0;?>
                    @foreach($promocion as $pro)
                        @if($vence->compras->productos->id == $pro->id_producto)
                            <?php $n++;?>
                        @endif
                    @endforeach
                    @if($n == 0)
                        <center>
                            <a class="btn btn-editar" href="{{route("promociones.create",["id"=>$vence->id])}}">
                                <i class="fa-solid fa-pen-to-square"></i>Crear promoción
                            </a>
                        </center>
                    @else
                    <center>
                        <span class="badge" style="background: rgb(235, 137, 137)">El producto tiene una promoción activa</span>
                        </center>
                    @endif
                </td>
            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
