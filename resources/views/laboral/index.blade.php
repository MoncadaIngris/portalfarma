@extends('plantilla.madre')
@section('titulo')
    Listado Laboral
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
            <th scope="col" class="sorting" style="text-align: center">Nombres</th>
            <th scope="col" class="sorting" style="text-align: center">H. Entrada</th>
            <th scope="col" class="sorting" style="text-align: center">H. Salida</th>
            <th scope="col" class="sorting" style="text-align: center">H. Ordinarias</th>
            <th scope="col" class="sorting" style="text-align: center">H. Extras</th>
            @can('empleados_editar')
                <th scope="col" style="text-align: center">Editar</th>
            @endcan
            @can('empleados_detalle')
                <th scope="col" style="text-align: center">Detalles</th>
            @endcan
        </tr>
        </thead>

        <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->nombres}}</td>

                @can('empleados_editar')
                    <td>
                        <center>
                            <a class="btn btn-editar" href="{{route("empleado.edit",["id"=>$empleado->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </center>
                    </td>
                @endcan
                @can('empleados_detalle')
                    <td>
                        <center>
                            <a class="btn btn-detalles" href="{{route("empleado.show",["id"=>$empleado->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                        </center>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>



            }
        </script>
    @endforeach
@stop
