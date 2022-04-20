@extends('plantilla.madre')
@section('titulo')
Añadir Usuario
@stop
@section('contenido')
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
<form method="POST" action="{{ route('registrar') }}">
    @csrf
    <script>
        function llenar(){
            var select = document.getElementById("empleado");
            var options=document.getElementsByTagName("option");

            var valor = select.value;

            @foreach ($empleados as $p)
                if(valor == {{$p->id}}){
                    var inputNombre = document.getElementById("nombres");
                    inputNombre.value = "{{$p->nombres}} {{$p->apellidos}}";

                    var inputDato = document.getElementById("identidad");
                    inputDato.value = "{{$p->identidad}}";

                    var inputDato = document.getElementById("identidad");
                    inputDato.value = "{{$p->DNI}}";

                    var inputDato = document.getElementById("email");
                    inputDato.value = "{{$p->correo_electronico}}";  
                    
                    var inputDato = document.getElementById("telefono");
                    inputDato.value = "{{$p->telefono_personal}}";
                }
            @endforeach
        }
    </script>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Empleado: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <select name="empleado" id="empleado" required="required" class="form-control"
            onchange="llenar()">
                <option style="display: none" value="">Seleccione un empleado</option>
                @foreach ($empleados as $e)
                    <option value="{{$e->id}}">{{$e->nombres}} {{$e->apellidos}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre completo: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control" readonly>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Identidad: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input maxlength="50" type="text" id="identidad" name="identidad" required="required" class="form-control" readonly>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Correo electrónico: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input maxlength="50" type="text" id="email" name="email" required="required" class="form-control" readonly>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Teléfono: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input maxlength="50" type="text" id="telefono" name="telefono" required="required" class="form-control" readonly>
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Función: <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <select name="funcion[]" id="funcion" required="required" class="form-control selectpicker" 
           data-live-search="true" multiple>
                @foreach ($funcion as $e)
                    <option value="{{$e->name}}">{{$e->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <button class="btn btn-regresar" type="button" onclick="window.location='{{route('usuarios.index')}}'">Cancelar</button>
            <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
            <button type="submit" class="btn btn-guardar">Guardar</button>
        </div>
    </div>

</form>
@stop