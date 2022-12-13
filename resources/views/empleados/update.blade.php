@extends('plantilla.madre')
@section('titulo')
    Editar Empleado
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
        <form id="form_empleados" enctype="multipart/form-data"
              action="{{route("empleado.edit",["id"=>$empleado->id])}}"
              method="post">
            @method("PUT")
            @csrf
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control "
                           @if(old("nombres"))
                           value="{{old("nombres")}}"
                           @else
                           value="{{$empleado->nombres}}"
                           @endif
                           >
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Apellidos: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="50" type="text" id="apellidos" name="apellidos" required="required" class="form-control"
                    placeholder="Ingrese los nombres"   
                        @if(old("apellidos"))
                           value="{{old("apellidos")}}"
                           @else
                           value="{{$empleado->apellidos}}"
                        @endif>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Correo Electrónico: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input maxlength="60" type="email" id="correo_electronico" name="correo_electronico" required="required" class="form-control"
                    placeholder="Ingrese el correo electrónico"      
                    pattern="^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
                title="Ingrese un correo electronico valido" 
                    @if(old("correo_electronico"))
                           value="{{old("correo_electronico")}}"
                           @else
                           value="{{$empleado->correo_electronico}}"
                        @endif>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Personal: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input maxlength="8" type="number" id="telefono_personal" name="telefono_personal" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           placeholder="Ingrese el teléfono personal"
                           @if(old("telefono_personal"))
                           value="{{old("telefono_personal")}}"
                           @else
                           value="{{$empleado->telefono_personal}}"
                        @endif
                        pattern="[9,8,3,2]{1}[0-9]{7}"
                title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos">

                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Emergencia: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input maxlength="8" type="tel" id="telefono_alternativo" name="telefono_alternativo" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           placeholder="Ingrese los nombres"
                           @if(old("telefono_alternativo"))
                           value="{{old("telefono_alternativo")}}"
                           @else
                           value="{{$empleado->telefono_alternativo}}"
                        @endif
                        pattern="[9,8,3,2]{1}[0-9]{7}"
                        title="Ingrese un numero telefónico valido que inicie con 2,3,8 o 9 y que contenga 8 digitos">
                </div>
            </div>

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Cargo: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <select name="cargo" id="cargo" required class="form-control">
                        <option value="{{$empleado->cargo}}" style="display: none">{{$empleado->cargos->descripcion}}</option>
                        @foreach ($cargo as $c)
                            <option value="{{$c->id}}">{{$c->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <?php $fecha_actual = date("d-m-Y");?>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de Nacimiento <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="fecha_de_nacimiento" name="fecha_de_nacimiento" class="date-picker form-control" placeholder="dd-mm-yyyy"
                           max="<?php echo date('Y-m-d',strtotime($fecha_actual."- 18 year"));?>"
                           placeholder="Ingrese el teléfono emergencia"
                           @if(old("fecha_de_nacimiento"))
                           value="{{old("fecha_de_nacimiento")}}"
                           @else
                           value="{{$empleado->fecha_de_nacimiento}}"
                           @endif
                           type="date" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)">
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
                <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de Ingreso: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="ingreso" name="ingreso" class="date-picker form-control" placeholder="dd-mm-yyyy" 
                    max="<?php echo date('Y-m-d',strtotime($fecha_actual));?>"
                    min="<?php echo date('Y-m-d',strtotime($empleado->fecha_de_ingreso));?>"
                    @if(old("ingreso"))
                           value="{{old("ingreso")}}"
                           @else
                           value="{{$empleado->fecha_de_ingreso}}"
                           @endif
                    type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)">
                    <script>
                        function timeFunctionLong(input) {
                            setTimeout(function() {
                                input.type = 'date';
                            }, 60000);
                        }
                    </script>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Identidad: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input maxlength="13" type="text" id="DNI" name="DNI" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           @if(old("DNI"))
                           value="{{old("DNI")}}"
                           @else
                           value="{{$empleado->DNI}}"
                        @endif
                        pattern="[0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9}"
                title="Ingrese un numero de identidad valido"
                placeholder="Ingrese la identidad sin guiones">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fotografía: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="file" id="foto" name="foto" accept="image/*" >
                    <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                    <img  class="rounded float-start"   id="imagenPrevisualizacion" src="{{asset($empleado->fotografia)}}"  width="200px" height="200px" alt=" ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <textarea maxlength="200" placeholder="Ingrese la dirección" name="direccion" id="direccion"  rows="7" required="required" class="form-control"
                    >@if(old("direccion")){{old("direccion")}}@else{{$empleado->direccion}}@endif</textarea>

                </div>

            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('empleados.index')}}'">Cancelar</button>
                    <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Restaurar</a>
                    <button type="submit" class="btn btn-guardar">Guardar</button>
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
