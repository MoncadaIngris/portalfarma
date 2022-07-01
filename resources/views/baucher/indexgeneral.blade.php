@extends('plantilla.madre')
@section('titulo')
    Listado de baucher generales
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
            <th scope="col" class="sorting" style="text-align: center">Fecha de inicio</th>
            <th scope="col" class="sorting" style="text-align: center">Fecha final</th>
            <th scope="col" class="sorting" style="text-align: center">Empleado</th>
            <th scope="col" class="sorting" style="text-align: center">Total ingresos</th>
            <th scope="col" class="sorting" style="text-align: center">Total deducciones</th>
            <th scope="col" class="sorting" style="text-align: center">Total a cobrar</th>
            <th scope="col" class="sorting" style="text-align: center">Detalles</th>        
        </tr>
        </thead>
            @foreach ($baucher as $b)
                <tr>
                    
                    <td>{{\Carbon\Carbon::parse($b->planillas->fecha_inicio)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                    <td>{{\Carbon\Carbon::parse($b->planillas->fecha_final)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                    <td>{{$b->empleados->nombres}} {{$b->empleados->apellidos}}</td>
                    <td style="text-align: right">L. {{number_format(($b->precio_hora*$b->hora_ordinaria)+($b->precio_hora*$b->hora_extra),2)}}</td>
                    <td style="text-align: right">L. {{number_format(($b->deducciones),2)}}</td>
                    <td style="text-align: right">L. {{number_format(($b->precio_hora*$b->hora_ordinaria)+($b->precio_hora*$b->hora_extra)-($b->deducciones),2)}}</td>
                    <td>
                        <center>
                            <a class="btn btn-detalles" href="{{route("baucher.mostrar",["id"=>$b->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                        </center>
                    </td>
                </tr>
            @endforeach
        <tbody>
        </tbody>
    </table>
@stop
