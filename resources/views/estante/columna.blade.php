@extends('plantilla.madre')
@section('titulo')
    Listado de columnas de fila
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
            
            <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
            <th scope="col" class="sorting" style="text-align: center">Producto</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->columna}}</td>
            <td>
                <?php $num = 0; ?>
                @foreach ($alternativo as $alt)
                @if ($alt->columna == $estante->columna)

                <?php $num++; ?>

                <span class="badge" style="background: rgb(241, 156, 220);color: black">{{ $alt->nombre }}</span>

                @endif
                @endforeach
                @if ($num == 0)
                <span class="badge" style="background: rgb(241, 156, 220);color: black">Sin productos asignados</span>
                @endif
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('estante.listado',['id'=>$estante->id_fila])}}'">
        Regresar
    </button>
@stop
