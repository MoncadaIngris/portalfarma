@extends('plantilla.madre')
@section('titulo')
    Listado de ventas
@stop
@section('contenido')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    