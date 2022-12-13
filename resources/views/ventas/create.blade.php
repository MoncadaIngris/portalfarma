@extends('plantilla.madre')
@section('titulo')
Nueva Venta
@stop
@section('contenido')
@if(session('mensaje'))
<div id="mensaje" class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif
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
<p style="width: 100%"><h3>cliente:</h3><a href='{{route('cliente.create2',["clie"=>$cliente])}}'>¿Desea agregar un nuevo cliente?</a></p>
<select name="cliente" id="cliente" required="required" class="form-control selectpicker" 
onchange="seleccionar()" data-live-search="true">
    @if ($cliente!=0)
    <option style="display: none" value="{{$clie->id}}">{{$clie->nombres}} {{$clie->apellidos}}</option>
    @else
    <option style="display: none" value="">Seleccione un cliente</option>
    @endif
    @foreach ($clientes as $clie)
        <option value="{{$clie->id}}">{{$clie->nombres}} {{$clie->apellidos}}</option>
    @endforeach
</select>
<br>
@if ($cliente !=0)
<div style="width: 100%;">
    <form method="post">
        @csrf
        <h2><center>Datos de la venta</center></h2>
        <br>
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

    @if(session('mensaje2'))
    <div id="mensaje2" class="alert alert-success">
        {{session('mensaje2')}}
    </div>
    @endif
    
        <div style="width: 20%; float: left;margin-right: 1%">
            <center><label for="">Producto:</label></center>
            <select name="productos" id="productos" class="form-control selectpicker" 
            data-live-search="true" onchange="ventas()">
            @if(old('productos'))
            @foreach ($productos as $p)
                @if (old('productos') == $p->id)
                    <option style="display: none" value="{{$p->id}}">{{$p->nombre}}</option>
                @endif
            @endforeach
            @else
                <option style="display: none" value="">Seleccione el producto</option>
            @endif
                @foreach ($productos as $p)
                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                @endforeach
            </select>
        </div>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script>
            function ventas(){
                var select = document.getElementById("productos");
                var options=document.getElementsByTagName("option");

                var valor = select.value;

                @foreach ($productos as $p)
                    if(valor == {{$p->id}}){
                        var y = document.getElementById("activar").disabled = false;
                        
                        var inputNombre = document.getElementById("venta");
                        inputNombre.value = "L.{{ number_format($p->venta,2)}}";

                        var inputDato = document.getElementById("impuesto");
                        inputDato.value = "{{$p->impuestos->descripcion}}";

                        var receta = document.getElementById("receta");
                        if({{$p->receta}} == 0){
                            receta.value = "Sin receta";
                            receta.style.background  = "green";
                            receta.style.color  = "black";
                        }else{
                            if({{$p->receta}} == 1){
                                receta.value = "Con receta";
                                receta.style.background  = "red";
                                receta.style.color  = "black";
                            }
                        }
                    }
                @endforeach
                var x = document.getElementById("oculto");
                x.style.display = "block";
                var c = 0;
                @foreach ($ubicacion as $ubi)
                if(valor == {{$ubi->id}}){
                    c++;
                    document.getElementById("aviso").value = "El producto esta ubicado en el estante {{$ubi->estantes->nombre}}, columna {{$ubi->columnas->numero}}, fila {{$ubi->filas->numero}}  ";
                }
                @endforeach
                if (c==0) {
                    document.getElementById("aviso").value = "El producto no ha sido ubicado";
                }

            }
        </script>  
        
        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Precio de Venta:</label></center>
            <input readonly type="text" placeholder="0.00" class="form-control" 
            id="venta" name="venta" style="text-align: right" value="{{old('venta')}}">
        </div>
        
        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Cantidad:</label></center>
            <input type="number" placeholder="0" class="form-control" id="cantidad" name="cantidad"
            min="1" maxlength="7" max="999999999" required value="{{old("cantidad")}}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>

        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Impuesto:</label></center>
            <input readonly type="text" placeholder="Porcentaje" 
            name="impuesto" id="impuesto" class="form-control" style="text-align: right" value="{{old('impuesto')}}">
        </div>
        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Receta:</label></center>
            <input readonly type="text"
            name="receta" id="receta" class="form-control" style="text-align: center" ">
        </div>
        <div style="width: 15%; float: left">
            <label for="" style="color: white">boton</label>
            <button class="btn btn-guardar" type="submit" id="activar" style="width: 100%" disabled>Agregar</button>
        </div>
    </form>
    <br>
<div style="display: none" id="oculto">
    <div style="width: 100%; float: left" >
        <input for="" readonly class="form-control" name="aviso" id="aviso" 
        style="background: rgb(32, 221, 189);color: black" value="">
    </div>
</div>
</div>
<div>

    <h2><center>Productos Facturados</center></h2>
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">Eliminar</th> 
       <th style="text-align: center">Producto</th> 
       <th style="text-align: center">Código</th> 
       <th style="text-align: center">Precio de Venta</th> 
       <th style="text-align: center">Cantidad</th> 
       <th style="text-align: center">Tasa de Impuesto</th> 
       <th style="text-align: center">Sub Total</th> 
       <th style="text-align: center">Total</th> 
    </tr>
        <?php 
        $subtotal =0;
        $impuesto = 0;
        ?>
        @forelse ($temporalv as $p)
            <tr>
                <td>
                    <form method="post" action="{{route('ventas.borrar',['id'=>$p->id,"cliente"=>$cliente])}}">
                        @csrf
                        @method('delete')
                        <center>
                            <button type="submit" class="btn-desactivar">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </center>
                    </form>
                </td>
                <td>{{$p->productos->nombre}}</td>
                <td style="text-align: center">{{$p->productos->codigo}}</td>
                <td style="text-align: right">L.{{ number_format($p->venta,2)}}</td>
                <td style="text-align: right">{{$p->cantidad}}</td>
                <td style="text-align: center">{{$p->impuestos->descripcion}}</td>
                <td style="text-align: right">L.{{ number_format($p->venta * $p->cantidad,2)}}</td>
                <?php $subtotal += $p->venta * $p->cantidad;?>
                <td style="text-align: right">L.{{ number_format(($p->venta * $p->cantidad)*(1+$p->impuestos->valor),2)}}</td>
                <?php $impuesto += ($p->venta * $p->cantidad)*$p->impuestos->valor;?>
            </tr>
        @empty
            <tr>
                <td colspan="8"><center>No hay datos</center></td>
            </tr>
        @endforelse
    <tr>
        <td style="text-align: right" colspan="7">Sub Total</td>
        <td style="text-align: right">L.{{ number_format($subtotal,2)}}</td>
    </tr>
    <tr>
        <td style="text-align: right" colspan="7">Impuesto</td>
        <td style="text-align: right">L.{{ number_format($impuesto,2)}}</td>
    </tr>
    <tr>
        <td style="text-align: right" colspan="7">Total</td>
        <td style="text-align: right">L.{{ number_format($subtotal+$impuesto,2)}}</td>
    </tr>
</table>

<form style="float: left" action="{{route('ventas.cancelar')}}" 
method="post">
@method("PUT")
@csrf
<button class="btn btn-regresar" type="submit">Cancelar</button>
</form>

<form style="float: left" action="{{route('ventas.limpiar',["cliente"=>$cliente])}}"
method="post">
@method("PUT")
@csrf
<button type="submit" class="btn btn-limpiar">Borrar todo</button>
</form>

<form style="float: left" action="{{route('ventas.save',["cliente"=>$cliente])}}"
method="post">
@method("PUT")
@csrf
<input type="text" id="monto_total" name="monto_total" value="{{$subtotal+$impuesto}}" style="display: none">
@if (count($temporalv) != 0)
<button type="submit" class="btn btn-guardar">Vender</button>
@else
<button type="submit" class="btn btn-guardar" disabled>Vender</button>
@endif
</form>
</div>
@endif


<script>
    function seleccionar(){

    location.href = url;
        var select = document.getElementById("cliente");
        var url = "{{ route('ventas.create', ['cliente' => 'temp']) }}";

        url = url.replace('temp', select.value);

        location.href = url;
    }
</script>

@stop
