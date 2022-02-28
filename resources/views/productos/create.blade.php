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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Código: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="text" id="codigo" name="codigo" required="required" class="form-control"
                value="{{old('codigo')}}"
                placeholder="Ingrese el código del producto el cual contiene 8 dígitos"
                pattern="[0-9]{8}"
                title="Ingrese un código de 8 dígitos">
            </div>
        </div>

       <div class="item form-group">   <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Concentración: <span class="required">*</span>    
      </label>   
        <div class="col-md-6 col-sm-6 ">          
    <Select required="required" class="form-control" id="concentracion" name="concentracion">               
     @foreach ($concentracion as $c)
         <option value="{{$c->id}}">{{$c->descripcion}}</option>
     @endforeach        
       </Select>        
    </div>       
    </div>   

      <div class="item form-group">     
       <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Receta: <span class="required">*</span>      
        </label> <div class="col-md-6 col-sm-6 ">    
        <Select required="required" class="form-control" id="receta" name="receta">    
        <option value="0">No</option>
        <option value="1">Si</option>
        </Select>
        </div>       
    </div>  
    <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Descripción: <span class="required">*</span>
            </label> <div class="col-md-6 col-sm-6 ">
                <textarea maxlength="200" type="text" id="descripcion" name="descripcion" required="required" class="form-control"
                value="{{old('descripcion')}}"
                placeholder="Ingrese la descripción ">{{old('descripcion')}}</textarea>
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