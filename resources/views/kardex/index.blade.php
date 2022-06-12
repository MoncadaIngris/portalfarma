@extends('plantilla.madre')
@section('titulo')
    Kardex @foreach ($prod as $pro)
    @if ($pro->id == $producto)
        {{$pro->nombre}}
    @endif
@endforeach
@stop
@section('contenido')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#mensaje2").fadeOut(1500);
        },3000);

        setTimeout(function() {
            $("#mensaje").fadeOut(1500);
        },3000);

        setTimeout(function() {
            $("#error").fadeOut(3000);
        },3000);
    });
    </script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
        .dataTables_filter{
            display: none !important;
            width: 200px !important;
        }
      </style>
    <div>
        <h3><strong><center>Informacion del producto @foreach ($prod as $pro)
            @if ($pro->id == $producto)
                {{$pro->nombre}}
            @endif
        @endforeach</center></strong></h3>
        <form action="{{route('kardex')}}" method="GET">
            <div style="width: 100%">
                <p >Producto:</p>
                <select name="producto" id="producto" required="required" class="form-control selectpicker" 
                onchange="this.form.submit()" data-live-search="true">
                @if ($producto)
                    @foreach ($prod as $pro)
                        @if ($pro->id == $producto)
                            <option style="display: none" value="{{$pro->id}}">{{$pro->nombre}}</option>
                        @endif
                    @endforeach
                @else
                    <option style="display: none" value="">Seleccione un Producto</option>
                @endif
                @foreach ($prod as $pro)
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                @endforeach
                </select>
            </div>
            <br>
        </form>
    @if ($producto)
    @if($errors->any())
        <div id="error" class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('kardex')}}" method="GET">
        <?php $fecha_actual = date("Y-m-d");?>
        <input type="text" name="producto" value="{{$producto}}" style="display: none">
        <div style="width: 100%">
            <div style="width: 33%;float: left;">
                <div style="float: left;width: 40%">
                    <center>
                        <label for="">Fecha Inicio:</label>
                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                        class="fas fa-calendar-alt"></i></span>
                    </center>
                </div>
                <div style="float: left;width: 60%">
                    <input type="date" class="form-control" id="start_date" name="start_date"
                    @if ($inicio)
                    value="{{date("Y-m-d", strtotime($inicio))}}"
                    @else
                    value="{{date("Y-m-d", strtotime($original))}}"
                    @endif
                    min="{{date("Y-m-d", strtotime($original))}}"
                    max="{{date("Y-m-d", strtotime($ultima))}}">
                </div>
            </div>
            
            <div style="width: 33%;float: left;margin-left: 2%">
                <div style="float: left;width: 40%">
                    <center>
                        <label for="">Fecha Final:</label>
                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                        class="fas fa-calendar-alt"></i></span>
                    </center>
                </div>
                <div style="float: left;width: 60%">
                    <input type="date" class="form-control" id="end_date" name="end_date"
                    @if ($final)
                    value="{{date("Y-m-d", strtotime($final))}}"
                    @else
                    value="{{date("Y-m-d", strtotime($ultima))}}"
                    @endif
                    min="{{date("Y-m-d", strtotime($original))}}"
                    max="{{$fecha_actual}}">
                </div>
            </div>
            <div style="width: 30%;float: left;margin-left: 2%">
               <button style="width: 45%" type="submit" class="btn btn-guardar">Filtrar</button>
               <a style="width: 45%" type="button" href="{{Route('kardex')}}" class="btn btn-regresar">Limpiar</a>
            </div>
        </div>
    </form>
</div>
<h3><strong><center>Entrada y Salida del Producto @foreach ($prod as $pro)
    @if ($pro->id == $producto)
        {{$pro->nombre}}
    @endif
@endforeach</center></strong></h3>
<div style="float: right;margin-right: 10px; width: 270px">
    <p><center>Descargar reporte:</center></p>
    <div class="dt-buttons btn-group">
        <a class="btn btn-default buttons-copy buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="javaScript:copyToClipBoard()"><span>Copiar</span></a>
        <a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="{{route('kardex.csv',['producto'=>$producto,'start_date'=>$inicio,'end_date'=>$final])}}"><span>CSV</span></a>
        <a class="btn btn-default buttons-excel buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="{{route('kardex.xlsx',['producto'=>$producto,'start_date'=>$inicio,'end_date'=>$final])}}"><span>Excel</span></a>
        <a class="btn btn-default buttons-pdf buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="{{route('kardex.pdf',['producto'=>$producto,'start_date'=>$inicio,'end_date'=>$final])}}"><span>PDF</span></a>
        <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="javaScript:printDiv()"><span>Imprimir</span></a></div>
</div>

@foreach ($prod as $pro)
@if ($pro->id == $producto)
    <?php $nombre = $pro->nombre?>
@endif
@endforeach

<script>
    function printDiv() {
        var divContents = document.getElementById("GFG").innerHTML;
        var a = window.open('', '', 'height=1000, width=1000');
        a.document.write('<html>');
        a.document.write('<body > <h1><center>Entradas y Salidas <br> <center> {{$nombre}} <br> <center> {{date("d/m/Y")}} <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.focus();
        a.print();
        a.close();
    }
    function copyToClipBoard() {

        var urlField = document.getElementById('datatable')   
        var range = document.createRange()
        range.selectNode(urlField)
        window.getSelection().addRange(range) 
        document.execCommand('copy')
        document.getSelection().removeAllRanges();
    }
</script>

    <table id="datatable" class="table table-bordered">
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
                <tr style="display: none">
                    <?php
                        $tU = $tU + $producto->cantidad_comprada - $producto->cantidad_vendida;
                        $tp = 0;
                    ?>
                    <th>{{$producto->created_at}}</th>
                    <th>{{$producto->descripcion}}</th>
                    <th>{{$producto->cantidad_comprada}}</th>
                    <th>{{$producto->compra}}</th>
                    <th>{{$producto->total}}</th>
                    <th>{{$producto->cantidad_vendida}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <?php 
                    $f = $producto->created_at;
                        $tt = $tt + $producto->total - ($pt*$producto->cantidad_vendida);
                        if($tU!=0){$pt = $tt/$tU;}
                    ?>
                </tr>
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
    @endif

    <div id="GFG" style="display: none">
        <link href="{{ asset('css/bootstrapcdn.css') }}" rel="stylesheet">
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
                    <tr style="display: none">
                        <?php
                            $tU = $tU + $producto->cantidad_comprada - $producto->cantidad_vendida;
                            $tp = 0;
                        ?>
                        <th>{{$producto->created_at}}</th>
                        <th>{{$producto->descripcion}}</th>
                        <th>{{$producto->cantidad_comprada}}</th>
                        <th>{{$producto->compra}}</th>
                        <th>{{$producto->total}}</th>
                        <th>{{$producto->cantidad_vendida}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <?php 
                        $f = $producto->created_at;
                            $tt = $tt + $producto->total - ($pt*$producto->cantidad_vendida);
                            if($tU!=0){$pt = $tt/$tU;}
                        ?>
                    </tr>
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
    </div>

@stop
