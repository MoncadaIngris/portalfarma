@extends('plantilla.madre')
@section('titulo')
Añadir Estante
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control "
                value="{{old('nombres')}}" placeholder="Ingrese el nombre del estante">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Descripcion: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="descripcion" name="descripcion" required="required" class="form-control "
                value="{{old('descripcion')}}" placeholder="Ingrese la descripcion del estante">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Numero de fila: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input max="100" type="number" id="fila" name="fila" required="required" class="form-control "
                value="{{old('fila')}}" placeholder="Ingrese el numero de fila">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Numero de columna: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input max="100" type="number" id="columna" name="columna" required="required" class="form-control "
                value="{{old('columna')}}" placeholder="Ingrese el numero de columna">
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('empleados.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop