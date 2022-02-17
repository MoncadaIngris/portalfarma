@extends('plantilla.madre')

@section('titulo')
    Editar Proveedor
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
        <form id="form_proveedors" enctype="multipart/form-data"
            action="{{route("proveedor.edit",["id"=>$proveedor->id])}}"
            method="post">
            @method("PUT")
            @csrf
            <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre Repartidor: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="nombre_repartidor" name="nombre_repartidor" required="required" class="form-control "
                @if(old('nombre_repartidor'))
                    value="{{old('nombre_repartidor')}}"
                @else
                    value="{{$proveedor->nombre_repartidor}}"
                @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre Proveedor: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="nombre_proveedor" name="nombre_proveedor" required="required" class="form-control"
                @if(old('nombre_proveedor'))
                    value="{{old('nombre_proveedor')}}"
                @else
                    value="{{$proveedor->nombre_proveedor}}"
                @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo Electrónico: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="email" id="correo_electronico" name="correo_electronico" required="required" class="form-control"
                @if(old('correo_electronico'))
                    value="{{old('correo_electronico')}}"
                @else
                    value="{{$proveedor->correo_electronico}}"
                @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Repartidor: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="tel" id="telefono_repartidor" name="telefono_repartidor" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos"
                @if(old('telefono_repartidor'))
                    value="{{old('telefono_repartidor')}}"
                @else
                    value="{{$proveedor->telefono_repartidor}}"
                @endif>

            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Proveedor: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="tel" id="telefono_proveedor" name="telefono_proveedor" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos"
                @if(old('telefono_proveedor'))
                    value="{{old('telefono_proveedor')}}"
                @else
                    value="{{$proveedor->telefono_proveedor}}"
                @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Día de Entrega: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select name="dia_de_entrega" id="dia_de_entrega" required="required" class="form-control">
                    <option value="{{$proveedor->dia_de_entrega}}" style="display: none">{{$proveedor->dia_de_entrega}}</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>
        </div>
            <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('proveedor.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop
