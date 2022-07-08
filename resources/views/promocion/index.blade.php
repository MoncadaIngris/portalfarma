@extends('plantilla.madre')
@section('titulo')
    Listado de promociones
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
        .dt-buttons{
            float: right !important;
        }
      </style>
    
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombre del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Código del producto</th>
            <th scope="col" class="sorting" style="text-align: center">Precio anterior</th>
            <th scope="col" class="sorting" style="text-align: center">Nuevo precio</th>
             <th scope="col" style="text-align: center">Cancelar</th>
             <th scope="col" style="text-align: center">Ventas</th>
             <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Detalles</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($promocion as $pro)
            <tr>
                <td style="text-align: center">{{$pro->productos->nombre}}</td>
                <td style="text-align: center">{{$pro->productos->codigo}}</td>
                <td style="text-align: right">L.{{ number_format($pro->anterior,2)}}</td>
                <td style="text-align: right">L.{{ number_format($pro->nuevo,2)}}</td>
                <td>
                <center>
                    <button onclick="desactivar{{$pro->id}}();" class="btn btn-desactivar"><i class="fa-solid fa-eye-slash"></i></button>
                </center>
                </td>
                <td>
                    <center>
                        <a class="btn btn-regresar" href="{{route("promociones.ventas",["id"=>$pro->id])}}">
                            <i class="fa-solid fa-box-open"></i>
                        </a>
                    </center>
                </td>
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("promociones.edit",["id"=>$pro->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
            
                    <td>
                        <center>
                <a class="btn btn-detalles" href="{{route("promociones.show",["id"=>$pro->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                        </center>
                    </td>

            </tr>

        @endforeach
        </tbody>
    </table>
    @foreach($promocion as $pro)
    <script>
        function desactivar{{$pro->id}}(){
            Swal.fire({
                title: '<strong>Cancelar Promocion</strong>',
                text: "¿Desea cancelar la promocion seleccionado?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Cancelada',
                        'La promocion fue cancelada exitosamente',
                        'success'
                    )
                    window.location='{{route("promociones.eliminar",["id"=>$pro->id])}}'
                }
            })

        }
    </script>
    @endforeach
        

@stop
