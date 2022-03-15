@extends('plantilla.madre')
@section('titulo')
    Empleados Activos
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('empleados.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Empleado</button>

    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Identidad</th>
            <th scope="col" class="sorting" style="text-align: center">Nombres</th>
            <th scope="col" class="sorting" style="text-align: center">Apellidos</th>
            <th scope="col" class="sorting" style="text-align: center">Teléfono</th>
            <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Detalles</th>
            <th scope="col" style="text-align: center">Desactivar</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->DNI}}</td>
                <td>{{$empleado->nombres}}</td>
                <td>{{$empleado->apellidos}}</td>
                <td>{{$empleado->telefono_personal}}</td>
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("empleado.edit",["id"=>$empleado->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
                <td>
                    <center>
            <a class="btn btn-detalles" href="{{route("empleado.show",["id"=>$empleado->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
                <td>
                    <center>
            <button onclick="desactivar{{$empleado->id}}();" class="btn btn-desactivar"><i class="fa-solid fa-eye-slash"></i></button>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($empleados as $empleado)
    <script>
        function desactivar{{$empleado->id}}(){
            Swal.fire({
                title: '<strong>Desactivar Empleado</strong>',
                text: "¿Desea desactivar el empleado seleccionado?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Desactivado',
                        'El empleado fue desactivado exitosamente',
                        'success'
                    )
                    window.location='{{route("empleados.desactivar",["id"=>$empleado->id])}}'
                }
            })

        }
    </script>
    @endforeach
@stop
