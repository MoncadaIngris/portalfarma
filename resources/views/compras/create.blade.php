@extends('plantilla.madre')
@section('titulo')
Nueva Compra
@stop
@section('contenido')
<p style="width: 100%"><h3>proveedor:</h3><a href='{{route('proveedor.create2',["prov"=>$proveedor])}}'>¿Desea agregar un proveedor?</a></p>
<select name="proveedor" id="proveedor" required="required" class="selectpicker form-control" 
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
    <h2><center>Datos de la compra</center></h2>
    <br>
    <div style="width: 24%; float: left;margin-right: 1%">
        <center><label for="">Producto:</label></center>
        <select name="productos" id="productos" required="required" class="form-control" >
            <option style="display: none" value="">Seleccione el producto</option>
            @foreach ($productos as $p)
                <option value="{{$p->id}}">{{$p->nombre}}</option>
            @endforeach
        </select>
    </div>
    
    <div style="width: 15%; float: left;margin-right: 1%">
        <center><label for="" >Precio de Compra:</label></center>
        <input type="number" placeholder="0.00" class="form-control">
    </div>
    
    <div style="width: 15%; float: left;margin-right: 1%">
        <center><label for="" >Precio de Venta:</label></center>
        <input type="number" placeholder="0.00" class="form-control">
    </div>
    
    <div style="width: 13%; float: left;margin-right: 1%">
        <center><label for="" >Cantidad:</label></center>
        <input type="number" placeholder="0.00" class="form-control">
    </div>
    
    <div style="width: 13%; float: left;margin-right: 1%">
        <center><label for="" >Impuesto:</label></center>
        <select name="productos" id="productos" required="required" class="form-control">
            <option style="display: none" value="0">0%</option>
            <option style="display: none" value="0.12">12%</option>
            <option style="display: none" value="0.15">15%</option>
        </select>
    </div>
    <div style="width: 15%; float: left">
        <label for="" style="color: white">boton</label>
        <button class="btn btn-guardar" style="width: 100%">Agregar</button>
    </div>
</div>
<div>

    <h2><center>Productos Facturados</center></h2>
<table class="table table-striped">
    <tr>
        <th>Eliminar</th> 
       <th>No</th> 
       <th>Producto</th> 
       <th>Codigo</th> 
       <th>Precio de Compra</th> 
       <th>Cantidad</th> 
       <th>Total</th> 
    </tr>
    <tr>
        <td colspan="7"><center>No hay datos</center></td>
    </tr>
    <tr>
        <td colspan="6">Sub Total</td>
        <td>0.00</td>
    </tr>
    <tr>
        <td colspan="6">Impuesto</td>
        <td>0.00</td>
    </tr>
    <tr>
        <td colspan="6">Total</td>
        <td>0.00</td>
    </tr>
</table>

<button class="btn btn-regresar" type="button" onclick="#">Cancelar</button>
<a type="button" href="#" class="btn btn-limpiar">Borrar todo</a>
<button type="submit" class="btn btn-guardar">Guardar</button>
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