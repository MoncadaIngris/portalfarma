@extends('plantilla.madre')
@section('titulo')
Nueva Compra
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
<p style="width: 100%"><h3>proveedor:</h3><a href='{{route('proveedor.create2',["prov"=>$proveedor])}}'>¿Desea agregar un nuevo proveedor?</a></p>
<select name="proveedor" id="proveedor" required="required" class="form-control selectpicker" 
onchange="seleccionar()" data-live-search="true">
    @if ($proveedor!=0)
    <option style="display: none" value="{{$prov->id}}">{{$prov->nombre_proveedor}}</option>
    @else
    <option style="display: none" value="">Seleccione un proveedor</option>
    @endif
    @foreach ($proveedors as $p)
        <option value="{{$p->id}}">{{$p->nombre_proveedor}}</option>
    @endforeach
</select>
<br>
@if ($proveedor!=0)
<div style="width: 100%;">
    <form method="post">
        @csrf
        <h2><center>Datos de la compra</center></h2>
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
        <div style="width: 24%; float: left;margin-right: 1%">
            <center><label for="">Producto:</label></center>
            <select name="productos" id="productos" class="form-control selectpicker" 
            data-live-search="true">
                <option style="display: none" value="">Seleccione el producto</option>
                @foreach ($productos as $p)
                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                @endforeach
            </select>
        </div>
        
        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Precio de Compra:</label></center>
            <input placeholder="0.00" class="form-control" id="compra" name="compra"
            min="0" max="999999.99" maxlength="10" type="number" step="any" required
            title="Formato de precio incorrecto" value="{{old("compra")}}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>
        
        <div style="width: 15%; float: left;margin-right: 1%">
            <center><label for="" >Precio de Venta:</label></center>
            <input placeholder="0.00" class="form-control" id="venta" name="venta"
            min="0" max="999999.99" maxlength="10" type="number" step="any" required
            title="Formato de precio incorrecto" value="{{old("venta")}}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>
        
        <div style="width: 13%; float: left;margin-right: 1%">
            <center><label for="" >Cantidad:</label></center>
            <input type="number" placeholder="0" class="form-control" id="cantidad" name="cantidad"
            min="0" maxlength="7" max="999999999" required value="{{old("cantidad")}}"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>
        
        <div style="width: 13%; float: left;margin-right: 1%">
            <center><label for="" >Impuesto:</label></center>
            <select name="impuesto" id="impuesto" class="form-control">
                @foreach ($impuestos as $imp)
                    <option value="{{$imp->id}}">{{$imp->descripcion}}</option>
                @endforeach
            </select>
        </div>
        <div style="width: 15%; float: left">
            <label for="" style="color: white">boton</label>
            <button class="btn btn-guardar" type="submit" style="width: 100%">Agregar</button>
        </div>
    </form>
</div>
<div>

    <h2><center>Productos Facturados</center></h2>
<table class="table table-striped">
    <tr>
        <th style="text-align: center">Eliminar</th> 
       <th style="text-align: center">Producto</th> 
       <th style="text-align: center">Código</th> 
       <th style="text-align: center">Precio de Compra</th> 
       <th style="text-align: center">Cantidad</th> 
       <th style="text-align: center">Tasa de Impuesto</th> 
       <th style="text-align: center">Sub Total</th> 
       <th style="text-align: center">Total</th> 
    </tr>
        <?php 
        $subtotal =0;
        $impuesto = 0;
        ?>
        @forelse ($temporal as $p)
            <tr>
                <td>
                    <form method="post" action="{{route('compras.borrar',['id'=>$p->id,"proveedor"=>$proveedor])}}">
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
                <td>{{$p->productos->codigo}}</td>
                <td>{{$p->compra}}</td>
                <td>{{$p->cantidad}}</td>
                <td>{{$p->impuestos->descripcion}}</td>
                <td>{{$p->compra * $p->cantidad}}</td>
                <?php $subtotal += $p->compra * $p->cantidad;?>
                <td>{{($p->compra * $p->cantidad)*(1+$p->impuestos->valor)}}</td>
                <?php $impuesto += ($p->compra * $p->cantidad)*$p->impuestos->valor;?>
            </tr>
        @empty
            <tr>
                <td colspan="8"><center>No hay datos</center></td>
            </tr>
        @endforelse
    <tr>
        <td colspan="7">Sub Total</td>
        <td>{{$subtotal}}</td>
    </tr>
    <tr>
        <td colspan="7">Impuesto</td>
        <td>{{$impuesto}}</td>
    </tr>
    <tr>
        <td colspan="7">Total</td>
        <td>{{$subtotal+$impuesto}}</td>
    </tr>
</table>

<form style="float: left" action="{{route('compras.cancelar')}}" 
method="post">
@method("PUT")
@csrf
<button class="btn btn-regresar" type="submit">Cancelar</button>
</form>

<form style="float: left" action="{{route('compras.limpiar',["proveedor"=>$proveedor])}}"
method="post">
@method("PUT")
@csrf
<button type="submit" class="btn btn-limpiar">Borrar todo</button>
</form>

<form style="float: left" action="{{route('compras.save',["proveedor"=>$proveedor])}}"
method="post">
@method("PUT")
@csrf
<input type="text" id="monto_total" name="monto_total" value="{{$subtotal+$impuesto}}" style="display: none">
<button type="submit" class="btn btn-guardar">Guardar</button>
</form>
</div>
@endif


<script>
    function seleccionar(){

    location.href = url;
        var select = document.getElementById("proveedor");
        var url = "{{ route('compras.create', ['proveedor' => 'temp']) }}";

        url = url.replace('temp', select.value);

        location.href = url;
    }
</script>

@stop