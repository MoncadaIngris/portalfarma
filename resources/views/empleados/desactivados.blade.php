@extends('plantilla.madre')
@section('titulo')
Listado de Empleados Desactivados
@stop
@section('contenido')
  @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">DNI</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Detalles</th>
        <th scope="col">Activar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($empleados as $empleado)
        <tr>
          <td>{{$empleado->DNI}}</td>
          <td>{{$empleado->nombres}}</td>
          <td>{{$empleado->apellidos}}</td>
          <td>{{$empleado->telefono_personal}}</td>
          <td><a class="btn btn-success" href="{{route("empleado.show",["id"=>$empleado->id])}}">Detalles</a></td>
          <td>
            <button onclick="activar();" class="btn btn-info">Activar</button>

            <script>
              function activar(){
                  Swal.fire({
                  title: '<strong>Activar Empleado</strong>',
                  text: "¿Desea activar el empleado seleccionado?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      Swal.fire(
                      'Desactivado',
                      'El empleado fue activado exitosamente',
                      'success'
                      )
                      window.location='{{route("empleados.activar",["id"=>$empleado->id])}}'
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
