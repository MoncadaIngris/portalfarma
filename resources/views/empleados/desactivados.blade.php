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
        <th scope="col" style="width: 17%; text-align: center">DNI</th>
        <th scope="col" style="width: 17%; text-align: center">Nombres</th>
        <th scope="col" style="width: 17%; text-align: center">Apellidos</th>
        <th scope="col" style="width: 17%; text-align: center">Teléfono</th>
        <th scope="col" style="width: 32%; text-align: center">Acción</th>
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
              <a class="btn btn-success" href="{{route("empleado.show",["id"=>$empleado->id])}}"><i class="fa-solid fa-circle-info"></i> Detalles</a>
            
              <button onclick="activar{{$empleado->id}}();" class="btn btn-info"><i class="fa-solid fa-eye"></i> Activar</button>
            </center>

            <script>
              function activar{{$empleado->id}}(){
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
