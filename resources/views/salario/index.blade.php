@extends('plantilla.madre')
@section('titulo')
    Listado de Salario por hora
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('salariohora.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Salario Hora</button>
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Cargo</th>
            <th scope="col" class="sorting" style="text-align: center">Salario por hora</th>
            <th scope="col" class="sorting" style="text-align: center">Salario por dia</th>
            <th scope="col" class="sorting" style="text-align: center">Salario semanal</th>       
        </tr>
        </thead>
        <tbody>
            @foreach ($salario as $s)
                <tr>
                    <td>{{$s->cargo->descripcion}}</td>
                    <td style="text-align: right">{{$s->salario_hora}}</td>
                    <td style="text-align: right">{{$s->salario_dia}}</td>
                    <td style="text-align: right">{{$s->salario_dia * 6}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
