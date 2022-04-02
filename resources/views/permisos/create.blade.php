@extends('plantilla.madre')
@section('titulo')
Añadir Permisos
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombres" name="nombres" required="required" class="form-control"
                value="{{old('nombres')}}"
                placeholder="Ingrese el nombre">
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Modelo: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select name="modelo" id="modelo" required="required" class="form-control" onchange="cambio()">
                    <option style="display: none" value="" >Seleccione el modelo</option>
                    @foreach ($modulo as $m)
                        <option value="{{$m->id}}">{{$m->descripcion}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <script>
            function cambio(){
                    $("#funcion").find('option').not(':first').remove();
                    var select = document.getElementById("modelo");
                    var valor = select.value;
                    var selectnw = document.getElementById("funcion");

                    @foreach ($funcion as $f)
                        if({{$f->id_modelo}} == valor){
                            
                            // creando la nueva option
                            var opt = document.createElement('option');

                            // Añadiendo texto al elemento (opt)
                            opt.innerHTML = "{{$f->descripcion}}";

                            //Añadiendo un valor al elemento (opt)
                            opt.value = "{{$f->id}}";

                            // Añadiendo opt al final del selector (sel)
                            selectnw.appendChild(opt);

                        }
                    @endforeach

                    @foreach ($modulo as $f)
                        if({{$f->id}} == valor){
                            
                            document.getElementById("descripcion").value = "{{$f->descripcion}}_";

                        }
                    @endforeach
                      
                  }
        </script>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Funcion: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select name="funcion" id="funcion" required="required" class="form-control" onchange="completar()">
                    <option style="display: none" value="" >Seleccione la funcion</option>
                </select>
            </div>
        </div>

        <script>
            function completar(){

                var select = document.getElementById("funcion");
                var valor = select.value;

                var select2 = document.getElementById("modelo");
                var valor2 = select2.value;

                @foreach ($modulo as $f)
                        if({{$f->id}} == valor2){
                            
                            document.getElementById("descripcion").value = "{{$f->descripcion}}_";

                        }
                    @endforeach

                @foreach ($funcion as $f)
                    if({{$f->id}} == valor){
                        
                        document.getElementById("descripcion").value += "{{$f->descripcion}}";

                    }
                @endforeach
            }
        </script>
                

    <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Descripción: <span class="required">*</span>
            </label> <div class="col-md-6 col-sm-6 ">
                <textarea maxlength="200" type="text" id="descripcion" name="descripcion" required="required" class="form-control"
                value="{{old('descripcion')}}" readonly
                placeholder="">{{old('descripcion')}}</textarea>
            </div>
        </div>
    <br>
    <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('permisos.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop