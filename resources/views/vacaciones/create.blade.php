@extends('plantilla.madre')
@section('titulo')
Asignar vacaciones
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
    <form method="post">
        @csrf
 
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre Del Empleado: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input  type="text" class="form-control" value="{{$empleado->nombres}} {{$empleado->apellidos}}" disabled>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Identidad: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
            <input  type="text" class="form-control" value="{{$empleado->DNI}}" disabled>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo electrónico: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
            <input  type="text" class="form-control" value="{{$empleado->correo_electronico}}" disabled>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Télefono: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
            <input  type="text" class="form-control" value="{{$empleado->telefono_personal}}" disabled>
            </div>
        </div>
        <?php $fecha_actual = date("d-m-Y");?>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de inicio: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="date" id="inicio" name="inicio" required="required" class="form-control"  min="<?php echo date('Y-m-d',strtotime($fecha_actual));?>"
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 3 month"));?>" value="{{old('inicio')}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de final: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="date" id="final" name="final" required="required" class="form-control"  min="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 1 day"));?>"
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 4 month"));?>" value="{{old('final')}}">
            </div>
        </div>
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