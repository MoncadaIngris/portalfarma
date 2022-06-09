@extends('plantilla.madre')
@section('titulo')
    Detalle de calendario de turnos
@stop
@section('contenido')
<center><h3>Generalidades de la semana</h3></center>
<div style="float: left; width: 45%">
    <label for="" style="float: left; width: 30%; line-height: 30px">Fecha de inicio</label>
    <input style="float: right; width: 70%" type="text" name="fecha_inicio" value="{{$calendario->semana->fecha_inicio}}" class="form-control " readonly>
</div>

<div style="float: right; width: 45%">
    <label for="" style="float: left;width: 30%; line-height: 30px">Fecha final</label>
    <input style="float: right;width: 70%" type="text" name="fecha_final" value="{{$calendario->semana->fecha_final}}" class="form-control " readonly>
</div>
<br><br>
<div style="float: left">
    <center><h3>Numero de empleados por jornada</h3></center>
    @foreach ($jornadas as $jornad)
    <?php $k = 0;?>
    @foreach ($empleados as $empleado)
        @if ($empleado->jornada->id == $jornad->id)
        <?php $k++;?>
        @endif
    @endforeach
    <div style="float: left; width: 19%; margin-right: 1%">
        <label for="" style="float: left;width: 55%; line-height: 30px; text-align: right">{{$jornad->nombre}}: </label>
        <input style="float: left;width: 45%; text-align: right" type="text" id="numemp{{$jornad->id}}" value="{{$k}}" class="form-control " readonly>
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
            <th scope="col" class="sorting">Hora de entrada</th>
            <th scope="col" class="sorting">Hora de salida</th>
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
            <td>{{$empleado->jornada->nombre}}</td>
            <td>{{$empleado->jornada->hora_entrada}}</td>
            <td>{{$empleado->jornada->hora_salida}}</td>
        </tr>
        @endforeach 
    </tbody>
</table>
<div class="ln_solid"></div>
<div class="item form-group">
    <div class="col-md-6 col-sm-6 offset-md-3">
        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('calendario.index')}}'">Regresar</button>
    </div>
</div>

@stop



