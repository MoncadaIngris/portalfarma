@extends('plantilla.madre')
@section('titulo')
Editar Clientes
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
    <form id="form_clientes" enctype="multipart/form-data"
              action="{{route("clientes.edit",["id"=>$clientes->id])}}"
              method="post">
            @method("PUT")
            @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control "
                @if(old("nombres"))
                           value="{{old("nombres")}}"
                           @else
                           value="{{$clientes->nombres}}"
                           @endif
                           >

            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellidos: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="apellidos" name="apellidos" required="required" class="form-control"
                @if(old("apellidos"))
                           value="{{old("apellidos")}}"
                           @else
                           value="{{$clientes->apellidos}}"
                           @endif
                           >
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="tel" id="personal" name="personal" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                placeholder="Ingrese el teléfono"
                @if(old("personal"))
                           value="{{old("personal")}}"
                           @else
                           value="{{$clientes->telefono}}"
                           @endif
                           
                pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos"
                >
                
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Identidad: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="13" type="text" id="dni" name="dni" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"

                
                @if(old("dni"))
                           value="{{old("dni")}}"
                           @else
                           value="{{$clientes->DNI}}"
                           @endif
                           pattern="[0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9}"
                           title="Ingrese un numero de identidad valido"
                           placeholder="Ingrese la identidad sin guiones"
                           >
                
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
            <textarea maxlength="200" placeholder="Ingrese la dirección" name="direccion" id="direccion"  rows="3" required="required" class="form-control"
                    >@if(old("direccion")){{old("direccion")}}@else{{$clientes->direccion}}@endif</textarea>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('clientes.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Restaurar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop