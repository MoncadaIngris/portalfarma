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
                    <input maxlength="100" type="text" id="nombres" name="nombres" required="required" class="form-control "
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
                    <input maxlength="100" type="text" id="apellidos" name="apellidos" required="required" class="form-control"
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
                    <input maxlength="100" type="email" id="correo_electronico" name="correo_electronico" required="required" class="form-control"
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
                           @if(old("telefono_personal"))
                           value="{{old("telefono_personal")}}"
                           @else
                           value="{{$empleado->telefono_personal}}"
                        @endif>

                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono Emergencia: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input maxlength="8" type="number" id="telefono_alternativo" name="telefono_alternativo" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           @if(old("telefono_alternativo"))
                           value="{{old("telefono_alternativo")}}"
                           @else
                           value="{{$empleado->telefono_alternativo}}"
                        @endif>
                </div>
            </div>
            <?php $fecha_actual = date("d-m-Y");?>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de Nacimiento <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="fecha_de_nacimiento" name="fecha_de_nacimiento" class="date-picker form-control" placeholder="dd-mm-yyyy"
                           max="<?php echo date('Y-m-d',strtotime($fecha_actual."- 18 year"));?>"
                           @if(old("fecha_de_nacimiento"))
                           value="{{old("fecha_de_nacimiento")}}"
                           @else
                           value="{{$empleado->fecha_de_nacimiento}}"
                           @endif
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
                    <input maxlength="13" type="number" id="DNI" name="DNI" required="required" class="form-control"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           @if(old("DNI"))
                           value="{{old("DNI")}}"
                           @else
                           value="{{$empleado->DNI}}"
                        @endif>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fotografía: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="file" id="foto" name="foto" accept="image/*" >
                    <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->
                    <img  class="rounded float-start"   id="imagenPrevisualizacion" src=""  width="200px" height="200px" alt=" ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <textarea maxlength="200" name="direccion" id="direccion"  rows="3" required="required" class="form-control"
                    >@if(old("direccion")){{old("direccion")}}@else{{$empleado->direccion}}@endif</textarea>

                </div>

            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-primary" type="button" onclick="window.location='{{route('empleados.index')}}'">Cancelar</button>
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