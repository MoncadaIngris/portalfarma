@extends('plantilla.madre')
@section('titulo')
Editar vacaciones
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
    @method("PUT")
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
        
        @if(date("Y-m-d") < $empleado->inicio)
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de inicio: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="date" id="inicio" name="inicio" required="required" class="form-control"  min="<?php echo date('Y-m-d',strtotime($fecha_actual));?>"
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 65 year"));?>" 
                @if(old("inicio"))
                    value="{{old("inicio")}}"
                    @else
                    value="{{$empleado->inicio}}"
                    @endif>
            </div>
        </div>
        @else
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de inicio: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="date" id="inicio" name="inicio" required="required" class="form-control"  min="<?php echo date('Y-m-d',strtotime($fecha_actual));?>"
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 65 year"));?>" readonly 
                @if(old("inicio"))
                    value="{{old("inicio")}}"
                    @else
                    value="{{$empleado->inicio}}"
                    @endif>
            </div>
        </div>
        @endif
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de final: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="date" id="final" name="final" required="required" class="form-control"  min="<?php echo date('Y-m-d',strtotime($empleado->inicio."+ 1 day"));?>"
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."+ 65 year"));?>" 
                @if(old("final"))
                    value="{{old("final")}}"
                    @else
                    value="{{$empleado->final}}"
                    @endif>
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