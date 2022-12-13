@extends('plantilla.madre')
@section('titulo')
Añadir Cliente
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control "
                value="{{old('nombres')}}" onkeydown="return /[a-zñÑ ]/i.test(event.key)"  minlength="3"
                placeholder="Ingrese los nombres">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellidos: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="apellidos" name="apellidos" required="required" class="form-control"
                value="{{old('apellidos')}}" onkeydown="return /[a-zñÑ ]/i.test(event.key)"  minlength="3"
                placeholder="Ingrese los apellidos">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="tel" id="personal" name="personal" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{old('personal')}}"
                pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos"
                placeholder="Ingrese el teléfono">
                
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Identidad: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="13" type="text" id="dni" name="dni" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{old('dni')}}"
                pattern="[0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9}"
                title="Recuerde que la identidad inicia con un numero entre 01 y 19 seguido por el numero del municipio"
                placeholder="Ingrese la identidad sin guiones">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <textarea maxlength="200" minlength="3" placeholder="Ingrese la dirección" name="direccion" id="direccion" name="direccion" cols="1" rows="3" required="required" class="form-control">{{old('direccion')}}</textarea>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                @if ($clie != -1)
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('ventas.create',['cliente'=>$clie])}}'">Cancelar</button>
                @else
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('clientes.index')}}'">Cancelar</button>
                @endif
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop