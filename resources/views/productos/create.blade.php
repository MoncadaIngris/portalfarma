@extends('plantilla.madre')
@section('titulo')
Añadir Producto
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
                <input maxlength="50" type="text" id="nombre" name="nombre" required="required" class="form-control"
                value="{{old('nombre')}}"
                placeholder="Ingrese el nombre del producto">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Codigo: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="number" id="codigo" name="codigo" required="required" class="form-control"
                value="{{old('codigo')}}"
                placeholder="Ingrese el codigo del producto"
                pattern="[0-9]"
                title="Ingrese un codigo valido">
            </div>
        </div>
    
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Concentracion: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="concentracion" name="concentracion" required="required" class="form-control "
                value="{{old('concentracion')}}"
                placeholder="Ingrese la concentracion">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Receta: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="receta" name="receta" required="required" class="form-control"
                value="{{old('receta')}}"
                placeholder="Ingrese la receta">
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Precio: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="number" id="precio" name="precio" required="required" class="form-control"
                value="{{old('precio')}}"
                placeholder="Ingrese el precio">
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Cantidad: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="number" id="cantidad" name="cantidad" required="required" class="form-control"
                value="{{old('cantidad')}}"
                placeholder="Ingrese la cantidad">
            </div>
        </div>
       <br>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('productos.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>
</div>
@stop