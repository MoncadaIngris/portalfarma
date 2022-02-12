@extends('plantilla.madre')
@section('titulo')
Crear Empleado
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="nombres" name="nombres" required="required" class="form-control "
                value="{{old('nombres')}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellidos: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="text" id="apellidos" name="apellidos" required="required" class="form-control"
                value="{{old('apellidos')}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo Electrónico: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="100" type="email" id="email" name="email" required="required" class="form-control"
                value="{{old('email')}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Personal: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="number" id="personal" name="personal" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{old('personal')}}"
                pattern="^[9|8|3|2]\d{7}$"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9">
                
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Emergencia: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="number" id="emergencia" name="emergencia" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{old('emergencia')}}"
                pattern="^[9|8|3|2]\d{7}$"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9">
            </div>
        </div>
        <?php $fecha_actual = date("d-m-Y");?>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de Nacimiento <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input id="birthday" name="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" 
                max="<?php echo date('Y-m-d',strtotime($fecha_actual."- 18 year"));?>"
                min="<?php echo date('Y-m-d',strtotime($fecha_actual."- 65 year"));?>"
                value="{{old('birthday')}}"
                type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                <script>
                    function timeFunctionLong(input) {
                        setTimeout(function() {
                            input.type = 'text';
                        }, 60000);
                    }
                </script>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">DNI: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="13" type="number" id="dni" name="dni" required="required" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                value="{{old('dni')}}"
                pattern="[0-1]{1}[0-8]{1}[0-9]{11}"
                title="Ingrese un numero de DNI valido">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fotografía: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="file" id="foto" name="foto" accept="image/*" name="imagen" >
                <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                <img  class="rounded float-start"   id="imagenPrevisualizacion" src="{{old('imagenPrevisualizacion')}}"  width="200px" height="200px" alt=" ">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <textarea maxlength="200" name="direccion" id="direccion" name="direccion" cols="1" rows="3" required="required" class="form-control">{{old('direccion')}}</textarea>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-primary" type="button" onclick="window.location='{{route('empleados.index')}}'">Cancelar</button>
                <button class="btn btn-primary" type="reset">Limpiar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>

    </form>
</div>
<script>
    const $seleccionArchivos = document.querySelector("#foto"),
    $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
    });
</script>
@stop