@extends('plantilla.madre')
@section('titulo')
Listado de Proveedores Desactivados
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
      <th scope="col" style="width: 17%; text-align: center">Nombre Repartidor</th>
        <th scope="col" style="width: 17%; text-align: center">Nombre Proveedor</th>
        <th scope="col" style="width: 17%; text-align: center">Teléfono Repartidor</th>
        <th scope="col" style="width: 17%; text-align: center">Dia de Entrega</th>
        <th scope="col" style="width: 32%; text-align: center">Acción</th>
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
              <a class="btn btn-detalles" href="{{route("proveedor.show",["id"=>$proveedor->id])}}"><i class="fa-solid fa-circle-info"></i> Detalles</a>

              <button onclick="activar{{$proveedor->id}}();" class="btn btn-activar"><i class="fa-solid fa-eye"></i> Activar</button>
            </center>
            

            <script>
              function activar{{$proveedor->id}}(){
                  Swal.fire({
                  title: '<strong>Activar Proveedor</strong>',
                  text: "¿Desea activar el proveedor seleccionado?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      Swal.fire(
                      'Desactivado',
                      'El proveedor fue activado exitosamente',
                      'success'
                      )
                      window.location='{{route("proveedor.activar",["id"=>$proveedor->id])}}'
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