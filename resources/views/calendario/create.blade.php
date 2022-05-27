@extends('plantilla.madre')
@section('titulo')
Añadir Calendario
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
<form method="post">
    @csrf
<div style="float: left; width: 45%">
    <label for="" style="float: left; width: 30%; line-height: 30px">Fecha de inicio</label>
    <input style="float: right; width: 70%" type="text" name="fecha_inicio" value="{{$semana->fecha_inicio}}" class="form-control " readonly>
</div>

<div style="float: right; width: 45%">
    <label for="" style="float: left;width: 30%; line-height: 30px">Fecha final</label>
    <input style="float: right;width: 70%" type="text" name="fecha_final" value="{{$semana->fecha_final}}" class="form-control " readonly>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="sorting">N°</th>
            <th scope="col" class="sorting">Nombre</th>
            <th scope="col" class="sorting">Identidad</th>
            <th scope="col" class="sorting">Jornada</th>
        </tr>
    </thead>

    <tbody>
        <?php $n=0?>
        @foreach($empleados as $empleado)
        <?php $n++?>
        <tr>
            <td>{{$n}}</td>
            <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
            <td>{{$empleado->DNI}}</td>
            <td>
                <select name="jornada{{$empleado->id}}" onchange="habilitar()" id="jornada[{{$empleado->id}}]" required="true" class="form-control selectpicker" 
                    data-live-search="true">
                    <option value="">Seleccione una opcion</option>
                    @foreach ($jornadas as $jornad)
                        <option value="{{$jornad->id}}">{{$jornad->nombre}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        @endforeach 
    </tbody>

    <script>
        function habilitar(){
            
            var n = {{$n}};
            var a = 0;

            @foreach($empleados as $empleado)
            if(document.getElementById('jornada['+{{$empleado->id}}+']').value != ""){
               a++;
            }
            @endforeach 

            let button = document.querySelector("#save");

            if(a == n){
                document.getElementById('alerta').style.visibility="hidden";
                button.disabled = false;
            }else{
                document.getElementById('alerta').style.visibility="";
                button.disabled = true;
            }

        }
    </script>



</table>
<label for="" style="color: red" id="alerta">Asignele una jornada a todos los empleados</label>
<div class="ln_solid"></div>
<div class="item form-group">
    <div class="col-md-6 col-sm-6 offset-md-3">
        <button class="btn btn-regresar" type="button" onclick="">Cancelar</button>
        <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
        <button type="submit" disabled id="save" class="btn btn-guardar">Guardar</button>
    </div>
</div>
</form>
@stop