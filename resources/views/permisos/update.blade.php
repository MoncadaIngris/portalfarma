@extends('plantilla.madre')
@section('titulo')
Editar Permisos
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
    <form id="form_permisos" enctype="multipart/form-data"
          action="{{route("permisos.edit",["id"=>$permisos->id])}}"
          method="post">
        @method("PUT")@csrf

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control "
                       @if(old("nombres"))
                       value="{{old("nombres")}}"
                       @else
                       value="{{$permisos->nombres}}"
                    @endif
                >
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Descripción: <span class="required">*</span>
            </label> <div class="col-md-6 col-sm-6 ">
                <textarea maxlength="200" type="text" id="descripcion" name="descripcion" required="required" class="form-control"
                          value="{{old('descripcion')}}"
                          placeholder="Ingrese la descripción ">@if(old("descripcion")){{old("descripcion")}}
                    @else{{$permisos->descripcion}}@endif</textarea>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('permisos.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Restaurar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop
