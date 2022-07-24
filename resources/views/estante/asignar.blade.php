@extends('plantilla.madre')
@section('titulo')
    Asignar producto a columna
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
<form action="" method="post">
    @csrf
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
            <th scope="col" class="sorting" style="text-align: center">Asignar producto</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->columna}}</td>
            <td>
                <select name="estante{{$estante->id}}"  id="estante[{{$estante->id}}]"  class="form-control">
<?php $num = 0; ?>
@foreach ($alternativo as $alt)
@if ($alt->columna == $estante->columna)

<?php $num++; ?>

<option value="{{$alt->producto_id}}">{{$alt->nombre}}</option>

@endif
@endforeach
@if ($num == 0)
<option value="">No asignado</option>
@endif
                    @foreach ($productos as $producto)
                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                    @endforeach
                </select>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="col-md-6 col-sm-6 offset-md-3">
        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('estante.listado',['id'=>$estante->id_fila])}}'">
            Cancelar
        </button>
        <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
        <button type="submit" id="save" class="btn btn-guardar">Guardar</button>
    </div>
</form>
@stop
