@extends('plantilla.madre')
@section('titulo')
Crear promoción {{$promocion->nombre}}
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
    <form method="post">
        @csrf
 
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre Del Producto: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text"class="form-control" value="{{$promocion->nombre}}" readonly>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Código del producto: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text"class="form-control" value="{{$promocion->codigo}}" readonly>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Precio del producto: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text"class="form-control" value="L.{{ number_format($promocion->venta,2)}}" readonly
                name="precioviejo" id="precioviejo">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha de vencimiento: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text"class="form-control" value="{{\Carbon\Carbon::parse($promocion->vencimiento)->locale("es")->isoFormat("DD MMMM YYYY")}}" readonly>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">porcentaje del descuento: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="number" class="form-control" name="descuento" id="descuento" style="width: 90%;float: left;"
                value="{{old('descuento')}}" style="text-align: right" min="1">
                <input type="text" class="form-control" value="%" readonly style="width: 10%;float: left;">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Descuento: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" value="L" readonly style="width: 10%;float: left;" >
                <input type="text" class="form-control" value="{{old('desc')}}" name="desc" id="desc" 
                style="width: 90%;float: left;" reandoly>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nuevo precio: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" value="L" readonly style="width: 10%;float: left;" >
                <input type="text"class="form-control" value="{{old('precionuevo')}}" name="precionuevo" 
                id="precionuevo" style="width: 90%;float: left;" reandoly>
            </div>
        </div>

        <script>
            setInterval('calcular()',1000);
            function calcular(){
                var descuento = document.getElementById('descuento').value;

                var desc = (Math.round(({{$promocion->venta}} * (descuento/100))*100))/100;

                var np = (Math.round(({{$promocion->venta}} - desc)*100))/100;

                document.getElementById('desc').value = desc;

                document.getElementById('precionuevo').value = np;
            }
        </script>

    <br>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location=''">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop
