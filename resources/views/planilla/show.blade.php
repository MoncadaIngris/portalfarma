@extends('plantilla.madre')
@section('titulo')
    Planilla del {{$p->fecha_inicio}} al {{$p->fecha_final}}
@stop
@section('contenido')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    <style>
        #prueba {
            overflow:auto;
        }
        .dt-buttons{
            float: right !important;
        }
    </style>
    
    @if (isset($alerta))
    <div class="alert alert-danger" role="alert">
        {{$alerta}}
      </div>
    @else
        @if (isset($confirmacion))
        <div class="alert alert-success" role="alert">
            {{$confirmacion}}
          </div>
        @else
            @if (isset($error))
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
            @endif
        @endif
    @endif

    <br><br>
    <div style="width: 100%">
        <div style="width: 50%; float: left;">
            <label for=""><Strong>Numero de empleados: </Strong></label>
            <label for="">{{count($planilla)}}</label>
        </div>
        <div style="width: 50%; float: right;">
            <?php $sum = 0?>
            <label for="" style="float: right;">
                @foreach ($planilla as $p)
                    <?php 
                        $sum= $sum + (($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora)-((($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora)*0.025);
                    ?>
                @endforeach
                L. {{number_format($sum,2)}}
            </label>
            <label for="" style="float: right;"><Strong>Total a pagar: </Strong></label>
        </div>
    </div>
    <table  class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Empleado</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Cargo</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Precio por Hora</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Lunes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Martes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Miercoles</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Jueves</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Viernes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="3">Sabado</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Total horas</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Sub-Total</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Deduccion</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Total</th>
        </tr>
        <tr>

            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora total</th>
            
        </tr>
        </thead>
            @forelse ($planilla as $p)
                <tr>
                    <td>{{$p->empleado->nombres}} {{$p->empleado->apellidos}}</td>
                    <td>{{$p->empleado->cargos->descripcion}}</td>
                    <td>L. {{$p->empleado->cargos->salario->salario_hora}}</td>


                    <td>{{$p->hora_ordinaria_lunes}}</td>
                    <td>{{$p->hora_extra_lunes}}</td>
                    <td>{{$p->hora_ordinaria_lunes + $p->hora_extra_lunes}}</td>

                    <td>{{$p->hora_ordinaria_martes}}</td>
                    <td>{{$p->hora_extra_martes}}</td>
                    <td>{{$p->hora_ordinaria_martes + $p->hora_extra_martes}}</td>

                    <td>{{$p->hora_ordinaria_miercoles}}</td>
                    <td>{{$p->hora_extra_miercoles}}</td>
                    <td>{{$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles}}</td>

                    <td>{{$p->hora_ordinaria_jueves}}</td>
                    <td>{{$p->hora_extra_jueves}}</td>
                    <td>{{$p->hora_ordinaria_jueves + $p->hora_extra_jueves}}</td>

                    <td>{{$p->hora_ordinaria_viernes}}</td>
                    <td>{{$p->hora_extra_viernes}}</td>
                    <td>{{$p->hora_ordinaria_viernes + $p->hora_extra_viernes}}</td>

                    <td>{{$p->hora_ordinaria_sabado}}</td>
                    <td>{{$p->hora_extra_sabado}}</td>
                    <td>{{$p->hora_ordinaria_sabado + $p->hora_extra_sabado}}</td>

                    <td>
                        {{$p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                        $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                        $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                        $p->hora_extra_sabado}}
                    </td>

                    <td>
                        L. {{number_format(($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora,2)}}
                    </td>

                    <td>
                        L. {{number_format((($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora)*0.025,2)}}
                    </td>

                    <td>
                        L. {{number_format((($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora)-((($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                            $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                            $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                            $p->hora_extra_sabado)*$p->precio_hora)*0.025),2)}}
                    </td>
                </tr>
            @empty
                
            @endforelse
        <tbody>
        </tbody>
    </table>

    <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('planilla.index')}}'">Regresar</button>
            </div>
        </div>
@stop
