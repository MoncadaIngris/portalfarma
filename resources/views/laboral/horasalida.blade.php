@extends('plantilla.madre')
@section('titulo')
Registrar hora entrada
@stop
@section('contenido')
<div class="x_content">
    <br />
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre empleado: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input  type="text" id="nombres" name="nombres" class="form-control" 
                value="{{$laboral->empleado->nombres}} {{$laboral->empleado->apellidos}}" readonly>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Identidad empleado: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input  type="text" id="nombres" name="nombres" class="form-control" 
                value="{{$laboral->empleado->DNI}}" readonly>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha actual: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nombres" name="nombres" class="form-control" 
                value="{{date("d-m-Y", strtotime($laboral->fecha))}}" readonly>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora entrada: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="time" id="entrada" name="entrada" class="form-control"  readonly value="{{$laboral->entrada->hora}}" >
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora salida: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="time" id="salida" name="salida" class="form-control"  required
                value="{{old('salida')}}" >
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('laborales.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>
    </form>
@stop