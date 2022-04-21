@extends('plantilla.madre')
@section('titulo')
Editar datos del usuario: {{auth()->user()->name}}
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
<form enctype="multipart/form-data" action="{{route("perfil.update")}}" method="post">
    @method("PUT")
    @csrf
    <div style="float: left;width: 16%">
        <input type="file" id="foto" name="foto" accept="image/*" value="{{asset(auth()->user()->empleados->fotografia)}}" style="color: white">
        <br>
        <img  class="rounded float-start" id="imagenPrevisualizacion" src="{{asset(auth()->user()->empleados->fotografia)}}" width="100%" height="100%" alt=" ">
        <br>
        </div>
        
        <div style="float: left;width: 40%;margin-left: 2%">
        
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Nombres: </label>
                <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->nombres}}" disabled>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Correo electrònico: </label>
                <input maxlength="60" type="email" id="correo_electronico" name="correo_electronico" required="required" class="form-control"
                    placeholder="Ingrese el correo electrónico" style="float: left;width: 60%;"  
                    pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
                title="Ingrese un correo electrònico valido" 
                    @if(old("correo_electronico"))
                           value="{{old("correo_electronico")}}"
                           @else
                           value="{{auth()->user()->empleados->correo_electronico}}"
                        @endif>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Telèfono alternativo: </label>
                <input maxlength="8" type="tel" id="telefono_alternativo" name="telefono_alternativo" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           placeholder="Ingrese los nombres" style="float: left;width: 60%;"
                           @if(old("telefono_alternativo"))
                           value="{{old("telefono_alternativo")}}"
                           @else
                           value="{{auth()->user()->empleados->telefono_alternativo}}"
                        @endif
                        pattern="[9,8,3,2]{1}[0-9]{7}"
                        title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos">
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Fecha de ingreso: </label>
                <input style="float: left;width: 60%;" type="date" class="form-control" value="{{auth()->user()->empleados->fecha_de_ingreso}}" disabled>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Direcciòn: </label>
                <textarea style="float: left;width: 60%;" maxlength="200" placeholder="Ingrese la dirección" name="direccion" id="direccion"  rows="3" required="required" class="form-control"
                    >@if(old("direccion")){{old("direccion")}}@else{{auth()->user()->empleados->direccion}}@endif</textarea>
            </div>
        
        </div>
        
        <div style="float: left;width: 40%;margin-left: 2%">
        
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Apellidos: </label>
                <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->apellidos}}" disabled>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Identidad: </label>
                <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->DNI}}" disabled>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Telèfono personal: </label>
                <input maxlength="8" type="number" id="telefono_personal" name="telefono_personal" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           placeholder="Ingrese el teléfono personal" style="float: left;width: 60%;"
                           @if(old("telefono_personal"))
                           value="{{old("telefono_personal")}}"
                           @else
                           value="{{auth()->user()->empleados->telefono_personal}}"
                        @endif
                        pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos">
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Fecha de nacimiento: </label>
                <input style="float: left;width: 60%;" type="date" class="form-control" value="{{auth()->user()->empleados->fecha_de_nacimiento}}" disabled>
            </div>
            <br><br><br>
            <div>
                <label style="float: left;width: 40%;line-height: 35px" for="">Funciòn: </label>
                <?php $i = 1?>
                <textarea style="float: left;width: 60%;" name="" id="" cols="30" rows="3" class="form-control" disabled >@forelse (auth()->user()->getRoleNames() as $roles) {{$i}}. {{$roles}}  <?php $i ++?> 
@empty Sin funciones @endforelse 
                </textarea>
            </div>
        
        </div>
        
        <div style="float: left;width:100%">
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('perfil')}}'">Cancelar</button>
                    <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                    <button type="submit" class="btn btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
</form>

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
