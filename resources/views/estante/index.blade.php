@extends('plantilla.madre')
@section('titulo')
    Listado de estantes
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
    @can('empleados_nuevo')
    <button class="btn btn-nuevo" onclick="window.location='{{route('estante.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Estante</button>
    @endcan
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombre</th>
            <th scope="col" class="sorting" style="text-align: center">Descripción</th>
            <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
            <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
            <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Filas</th>
            <th scope="col" style="text-align: center">Detalles</th>
            <th scope="col" style="text-align: center">Eliminar Productos</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->nombre}}</td>
            <td>{{$estante->descripcion}}</td>
            <td style="text-align: center">{{$estante->fila}}</td>
            <td style="text-align: center">{{$estante->columna}}</td>
            <td>
                    <center>
            <a class="btn btn-editar" href="{{route("estante.edit",["id"=>$estante->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
            <td>
            <center>
            <a class="btn btn-guardar" href="{{route("estante.listado",["id"=>$estante->id])}}"><i class="fa-solid fa-bars"></i></a>
                    </center>
            </td>
            <td>
                <center>
                    <a class="btn btn-detalles" href="{{route("estante.detalles",["id"=>$estante->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                </center>
            </td>
            <td>
                <center>
                    <button onclick="desactivar{{$estante->id}}();" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </center>

                <script>
                    function desactivar{{$estante->id}}(){
                        Swal.fire({
                            title: '<strong>Eliminar productos</strong>',
                            text: "¿Desea eliminar los productos del estante {{$estante->nombre}}?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Aceptar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Eliminado',
                                    'Los productos fueron eliminados exitosamente',
                                    'success'
                                )
                                window.location='{{route("estante.eliminar",["id"=>$estante->id])}}'
                            }
                        })

                    }
                </script>

            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
