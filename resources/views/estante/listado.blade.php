@extends('plantilla.madre')
@section('titulo')
    Listado de filas de estantes
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
            
            <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
            <th scope="col" class="sorting" style="text-align: center">Productos</th>
            <th scope="col" style="text-align: center">Columnas</th>
            <th scope="col" style="text-align: center">Asignar</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->fila}}</td>
            <td>
                <?php $num = 0; ?>
                @foreach ($alternativo as $alt)
                    @if ($alt->fila == $estante->fila)

                    <?php $num++; ?>

                    <span class="badge" style="background: rgb(241, 156, 220);color: black">{{ $alt->nombre }}</span>

                    @endif
                @endforeach
                @if ($num == 0)
                <span class="badge" style="background: rgb(241, 156, 220);color: black">Sin productos asignados</span>
                @endif
            </td>
            <td>
                <center>
                    <a class="btn btn-guardar" href="{{route("estante.columna",["id"=>$estante->id])}}">
                        <i class="fa-solid fa-barcode"></i>
                    </a>
                </center>
            </td>
            <td>
                @if ($num == 0)
                <center>
                    <a class="btn btn-editar" href="{{route("columna.asignar",["id"=>$estante->id])}}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </center>
                @else
                <center>
                    <a class="btn btn-editar" href="{{route("columna.editar",["id"=>$estante->id])}}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </center>
                @endif
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('estante.index')}}'">
        Regresar
    </button>
@stop
