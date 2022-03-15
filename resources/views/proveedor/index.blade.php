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
<button class="btn btn-nuevo" onclick="window.location='{{route('proveedor.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Proveedores</button>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="sorting" style="text-align: center">Nombre Repartidor</th>
        <th scope="col" class="sorting" style="text-align: center">Nombre Proveedor</th>
        <th scope="col" class="sorting" style="text-align: center">Teléfono Repartidor</th>
        <th scope="col" class="sorting" style="text-align: center">Día de Entrega</th>
        <th scope="col" style="text-align: center">Editar</th>
        <th scope="col" style="text-align: center">Detalles</th>
        <th scope="col" style="text-align: center">Desactivar</th>
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
              <a class="btn btn-editar" href="{{route("proveedor.edit",["id"=>$proveedor->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
            </center>
          </td>
          <td>
              <center>
              <a class="btn btn-detalles" href="{{route("proveedor.show",["id"=>$proveedor->id])}}"><i class="fa-solid fa-circle-info"></i></a>
            </center>
          </td>
          <td>
              <center>
              <button onclick="desactivar{{$proveedor->id}}();" class="btn btn-desactivar"><i class="fa-solid fa-eye-slash"></i></button>
            </center>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @foreach ($provee as $proveedor)
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
            window.location='{{route("proveedor.desactivar",["id"=>$proveedor->id])}}'
        }
        })
        
    }
</script>
  @endforeach
@stop
