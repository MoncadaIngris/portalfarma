<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <h3><center>{{ $title }} {{ $date }}</center></h3>

    <table class="table table-bordered">
        <thead>
    
            <tr style="border-bottom: 0px;">
                <th scope="col" rowspan="2" style="vertical-align:middle;font-size: 12px;width: 21%" >Fecha</th>
                <th scope="col" rowspan="2" style="vertical-align:middle;font-size: 12px;width: 10%" >Descripcion</th>
                <th scope="col" colspan="3" style="text-align: center;width: 23%">Entrada</th>
                <th scope="col" colspan="3" style="text-align: center;width: 23%">Salida</th>
                <th scope="col" colspan="3" style="text-align: center;width: 23%">Existencia</th>
            </tr>        
            <tr style="font-size: 12px;">
                <th scope="col"  style="vertical-align:middle;" >Unidades</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Unitario</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Total</th>
                <th scope="col"  style="vertical-align:middle;" >Unidades</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Unitario</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Total</th>
                <th scope="col"  style="vertical-align:middle;" >Unidades</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Unitario</th>
                <th scope="col"  style="vertical-align:middle;" >Costo Total</th>
            </tr>
        </thead>
    
        <tbody>
            <?php
                $tU = 0;
                $tp = 0;
                $tt = 0;
                $pt = 0;
            ?>
            @foreach ($oldproductos as $producto)
                    <?php
                        $tU = $tU + $producto->cantidad_comprada - $producto->cantidad_vendida;
                        $tp = 0;
    
                        $tt = $tt + $producto->total - ($pt*$producto->cantidad_vendida);
                        if($tU!=0){$pt = $tt/$tU;}
                    ?>
            @endforeach
            <tr>
                <td></td>
                <td>Existencia</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">L.{{ number_format($tU,2)}}</td>
                <td style="text-align: right">L.{{ number_format($pt,2)}}</td>
                <td style="text-align: right">L.{{ number_format($tt,2)}}</td>
            </tr>
            @foreach ($productos as $producto)
            <tr>
                <?php
                    $tU = $tU + $producto->cantidad_comprada - $producto->cantidad_vendida;
                    $tp = 0;
                ?>
                <td style="font-size: 12px">{{date_format($producto->created_at,"h:i a d/m/Y")}}</td>
                <td>{{$producto->descripcion}}</td>
                <td style="text-align: right">{{ number_format($producto->cantidad_comprada)}}</td>
                <td style="text-align: right">L.{{ number_format($producto->compra,2)}}</td>
                <td style="text-align: right">L.{{ number_format($producto->total,2)}}</td>
                <td style="text-align: right">{{ number_format($producto->cantidad_vendida)}}</td>
                <td style="text-align: right">
                    @if (number_format($producto->cantidad_vendida) != 0)
                        L.{{ number_format($pt,2)}}
                    @else
                        L.{{ number_format(0,2)}}
                    @endif
                </td>
                <td style="text-align: right">
                
                    @if (number_format($producto->cantidad_vendida) != 0)
                        L.{{ number_format($pt*$producto->cantidad_vendida,2)}}
                    @else
                        L.{{ number_format(0,2)}}
                    @endif
                
                </td>
    
                <?php 
                $tt = $tt + $producto->total - ($pt*$producto->cantidad_vendida);
                if($tU!=0){$pt = $tt/$tU;}
                ?>
    
                <td style="text-align: right">L.{{ number_format($tU,2)}}</td>
                <td style="text-align: right">L.{{ number_format($pt,2)}}</td>
                <td style="text-align: right">L.{{ number_format($tt,2)}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

</body>
</html>
