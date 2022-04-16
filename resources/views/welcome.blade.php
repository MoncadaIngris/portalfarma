@extends('plantilla.madre')
@section('titulo')

@stop
@section('contenido')
@if(session('denegar'))
<div id="mensaje" class="alert alert-danger">
    {{session('denegar')}}
</div>
@endif

@stop