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
    <style>
      #prueba {
          overflow:auto;
      }
    </style>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="sorting" style="text-align: center">Identidad</th>
        <th scope="col" class="sorting" style="text-align: center">Nombres</th>
        <th scope="col" class="sorting" style="text-align: center">Apellidos</th>
        <th scope="col" class="sorting" style="text-align: center">Teléfono</th>
        <th scope="col" style="text-align: center">Detalles</th>
        <th scope="col" style="text-align: center">Activar</th>
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
              <a class="btn btn-detalles" href="{{route("empleado.show",["id"=>$empleado->id])}}"><i class="fa-solid fa-circle-info"></i></a>
            </center>
          </td>
          <td>
            <center>
              <button onclick="activar{{$empleado->id}}();" class="btn btn-activar"><i class="fa-solid fa-eye"></i></button>
            </center>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  @foreach($empleados as $empleado)
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
  @endforeach
@stop
