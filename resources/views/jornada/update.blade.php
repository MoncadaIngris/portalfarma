@extends('plantilla.madre')
@section('titulo')
Editar jornada
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
    <form method="post" enctype="multipart/form-data"
       action="{{route("jornada.edit",["id"=>$jornadas->id])}}"
              method="post">
            @method("PUT")
        @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select id="nombres" name="nombres" required="required" class="form-control ">
                    <option value="{{$jornadas->nombre}}" style="display: none">{{$jornadas->nombre}}</option>
                    <option value="Diurno">Diurno</option>
                    <option value="Nocturna">Nocturna</option>
                    <option value="Mixto">Mixto</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
                </div>
            </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora de entrada: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="time" id="entrada" name="entrada" required="required" class="form-control "
                @if(old("entrada"))
                    value="{{old("entrada")}}"
                    @else
                    value="{{$jornadas->hora_entrada}}"
                    @endif>    
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora de salida: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="time" id="salida" name="salida" required="required" class="form-control " 
                
                @if(old("salida"))
                           value="{{old("salida")}}"
                           @else
                           value="{{$jornadas->hora_salida}}"
                           @endif
                           >
                </div>
            </div>
                
           
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Total de horas: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" id="total" name="total" disabled class="form-control">
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Máximo de empleados: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="number" id="empleados" name="empleados" required="required" class="form-control "
                placeholder="Ingrese el numero maáimo de empleados de esta jornada"
                @if(old("empleados"))
                           value="{{old("empleados")}}"
                           @else
                           value="{{$jornadas->numero_empleados}}"
                           @endif>
            </div>
        </div>

        <script>
            setInterval('calculo()',1000);
            function calculo(){
                var entrada = document.getElementById('entrada').value;
                var salida = document.getElementById('salida').value;

                if (entrada != '' && salida != '') {
                    var arrayentrada = entrada.split(':');
                    var arraysalida = salida.split(':');

                    var totalentrada = new Date(2011, 0, 1,arrayentrada[0],arrayentrada[1],0,0);
                    var totalsalida = new Date(2011, 0, 1, arraysalida[0],arraysalida[1],0,0);

                    var hora_entrada = totalentrada.getHours();
                    var minuto_entrada = totalentrada.getMinutes();
                    var hora_salida = totalsalida.getHours();
                    var minuto_salida = totalsalida.getMinutes();

                    var horas = 0;
                    if (hora_salida>=hora_entrada) {
                        var horas = hora_salida-hora_entrada-1;
                    } else {
                        var horas = 24-hora_entrada + hora_salida-1;
                    }

                    var minutos = 60 - minuto_entrada + minuto_salida;

                    if (minutos == 60) {
                        minutos = 0;
                        horas ++;
                    }else{
                        if(minutos > 60){
                            minutos = minutos - 60;
                            horas ++;
                        }
                    }

                    document.getElementById('total').value =horas+' horas y '+minutos+' minutos';

                } else {
                    document.getElementById('total').value = 'Calculo de horas laborales';
                }

            }
        </script>

        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('jornada.index')}}'">Cancelar</button>

                
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
        
@stop
        
