@extends('plantilla.madre')
@section('titulo')
Editar Calendario
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
    @method("PUT")
    <center><h3>Generalidades de la semana</h3></center>
<div style="float: left; width: 45%">
    <label for="" style="float: left; width: 30%; line-height: 30px">Fecha de inicio</label>
    <input style="float: right; width: 70%" type="text" name="fecha_inicio" value="{{date("d-m-Y", strtotime($calendario->semana->fecha_inicio))}}" class="form-control " readonly>
</div>

<div style="float: right; width: 45%">
    <label for="" style="float: left;width: 30%; line-height: 30px">Fecha final</label>
    <input style="float: right;width: 70%" type="text" name="fecha_final" value="{{date("d-m-Y", strtotime($calendario->semana->fecha_final))}}" class="form-control " readonly>
</div>
<br><br>
<div style="float: left">
    <center><h3>Numero de empleados por jornada</h3></center>
    @foreach ($jornadas as $jornad)
    <div style="float: left; width: 19%; margin-right: 1%">
        <label for="" style="float: left;width: 55%; line-height: 30px; text-align: right">{{$jornad->nombre}}: </label>
        <input style="float: left;width: 45%; text-align: right" type="text" id="numemp{{$jornad->id}}" value="0" class="form-control " readonly>
    </div>
    @endforeach
</div>
<br><br><br>
<center><h3>Asignar jornada a los empleados</h3></center>
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
            <td>{{$empleado->empleado->nombres}} {{$empleado->empleado->apellidos}}</td>
            <td>{{$empleado->empleado->DNI}}</td>
            <td>
                <select name="jornada{{$empleado->id}}" onchange="determi({{$empleado->id}})"  id="jornada[{{$empleado->id}}]" required="true" class="form-control">
                    <option style="display: none" value="{{$empleado->jornada->id}}">{{$empleado->jornada->nombre}}</option>
                    @foreach ($jornadas as $jornad)
                        <option value="{{$jornad->id}}">{{$jornad->nombre}}</option>
                    @endforeach
                </select>
                <label for="" id="text{{$empleado->id}}" style="color: red;"></label>
            </td>
        </tr>
        @endforeach 
    </tbody>

    <script>
        window.onload = function () {
            determi({{$empleado->id}});
        }
        function determi(id){
            document.getElementById('text'+id).innerHTML = "";
            var emple = document.getElementById('jornada['+id+']').value;
            var jorn = document.getElementById('numemp'+emple).value;
            var dat = 0;
            var combo = document.getElementById('jornada['+id+']');
            var selected = combo.options[combo.selectedIndex].text;
            @foreach ($jornadas as $jornad)
            if (emple == {{$jornad->id}}) {
                dat = {{$jornad->numero_empleados}};
            }
            @endforeach
            if (dat > jorn) {
                @foreach ($jornadas as $jornad)
                    var numero = 0;
                    var val = {{$jornad->id}};
                    @foreach($empleados as $empleado)
                        var emple = document.getElementById('jornada['+{{$empleado->id}}+']').value;
                        if (val == emple) {
                            numero++;   
                        }
                    @endforeach
                    document.getElementById('numemp'+{{$jornad->id}}).value = numero;
                @endforeach
            } else {
                document.getElementById('jornada['+id+']').selectedIndex = 0;
                document.getElementById('text'+id).innerHTML = "La jornada "+selected+" no puede tener mas de "+dat+" empleados asignados";
            }
        }


        setInterval('habilitar()',1000);
        function habilitar(){
            
            var n = {{$n}};
            var a = 0;

            @foreach($empleados as $empleado)
            if(document.getElementById('jornada['+{{$empleado->empleado->id}}+']').value != ""){
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
        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('calendario.index')}}'">Cancelar</button>
        <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Restaurar</a>
        <button type="submit" disabled id="save" class="btn btn-guardar">Guardar</button>
    </div>
</div>
</form>
@stop