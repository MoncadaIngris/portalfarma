@extends('plantilla.madre')
@section('titulo')
Listado de Proveedores
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
<button class="btn btn-info" onclick="window.location='{{route('proveedor.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Proveedores</button>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" style="width: 15%; text-align: center">Nombre Repartidor</th>
        <th scope="col" style="width: 15%; text-align: center">Nombre Proveedor</th>
        <th scope="col" style="width: 15%; text-align: center">Teléfono Repartidor</th>
        <th scope="col" style="width: 15%; text-align: center">Dia de Entrega</th>
        <th scope="col" style="width: 40%; text-align: center">Acción</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($proveedor as $proveedor)
        <tr>

          <td>{{$proveedor->nombre_repartidor}}</td>
          <td>{{$proveedor->nombre_proveedor}}</td>
          <td>{{$proveedor->telefono_repartidor}}</td>
          <td>{{$proveedor->dia_de_entrega}}</td>
          <td>
            <center>
              <a class="btn btn-warning" href="{{route("proveedor.edit",["id"=>$proveedor->id])}}"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
              <a class="btn btn-success" href="{{route("proveedor.show",["id"=>$proveedor->id])}}"><i class="fa-solid fa-circle-info"></i>Detalles</a>
              <button onclick="desactivar{{$proveedor->id}}();" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i>Desactivar</button>
            </center>
            <script>
              function desactivar{{$proveedor->id}}(){
                  Swal.fire({
                  title: '<strong>Desactivar Proveedor</strong>',
                  text: "¿Desea desactivar el proveedor seleccionado?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      Swal.fire(
                      'Desactivado',
                      'El proveedor fue desactivado exitosamente',
                      'success'
                      )
                      window.location='{{route("empleados.desactivar",["id"=>$empleado->id])}}'
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
