<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <h3><center>{{ $title }}</center></h3>

    <table style="font-size: 11px;" id="data" class="table table-striped table-bordered">
        <thead>
        <tr>
             <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Empleado</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Cargo</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Precio por hora</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Lunes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Martes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Miércoles</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Jueves</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Viernes</th>
            <th scope="col" class="sorting" style="text-align: center;" colspan="2">Sábado</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Total horas</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Sub-Total</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Deducción</th>
            <th scope="col" class="sorting" style="text-align: center;" rowspan="2">Total</th>
        </tr>
        <tr>

            @for ($i=0; $i<6; $i++)
            <th scope="col" class="sorting" style="text-align: center;">Hora ordinaria</th>
            <th scope="col" class="sorting" style="text-align: center;">Hora extra</th>
            @endfor
            
        </tr>
        </thead>
            @forelse ($planilla as $p)
                <tr>
                    <td>{{$p->empleado->nombres}} {{$p->empleado->apellidos}}</td>
                    <td>{{$p->empleado->cargos->descripcion}}</td>
                    <td>L. {{$p->empleado->cargos->salario->salario_hora}}</td>


                    <td>{{$p->hora_ordinaria_lunes}}</td>
                    <td>{{$p->hora_extra_lunes}}</td>

                    <td>{{$p->hora_ordinaria_martes}}</td>
                    <td>{{$p->hora_extra_martes}}</td>

                    <td>{{$p->hora_ordinaria_miercoles}}</td>
                    <td>{{$p->hora_extra_miercoles}}</td>

                    <td>{{$p->hora_ordinaria_jueves}}</td>
                    <td>{{$p->hora_extra_jueves}}</td>

                    <td>{{$p->hora_ordinaria_viernes}}</td>
                    <td>{{$p->hora_extra_viernes}}</td>

                    <td>{{$p->hora_ordinaria_sabado}}</td>
                    <td>{{$p->hora_extra_sabado}}</td>

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
    

</body>
</html>
