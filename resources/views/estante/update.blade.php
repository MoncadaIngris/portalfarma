@extends('plantilla.madre')
@section('titulo')
Editar Estante
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
    <form id="form_estante" enctype="multipart/form-data"
              action="{{route("estante.edit",["id"=>$estante->id])}}"
              method="post">
            @method("PUT")
            @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="nombres" name="nombres" placeholder="Ingrese el nombre del estante" required="required" class="form-control"
                @if(old("nombres"))
                           value="{{old("nombres")}}"
                           @else
                           value="{{$estante->nombre}}"
                           @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Descripción: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="200" type="text" id="descripcion" name="descripcion" required="required" class="form-control "
                @if(old("descripcion"))
                value="{{old('descripcion')}}" 
                @else
                           value="{{$estante->descripcion}}"
                           @endif
                placeholder="Ingrese la descripcion del estante">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Número de fila: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input max="15" min="0" type="number" id="fila" name="fila" required="required" class="form-control "
                @if(old("fila"))
                value="{{old('fila')}}" 
                @else
                           value="{{$estante->fila}}"
                           @endif
                placeholder="Ingrese el numero de fila">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Número de columna: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input max="15" min="0" type="number" id="columna" name="columna" required="required" class="form-control "
                @if(old("columna"))
                value="{{old('columna')}}" 
                @else
                           value="{{$estante->columna}}"
                           @endif
                placeholder="Ingrese el numero de columna">
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('estante.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop