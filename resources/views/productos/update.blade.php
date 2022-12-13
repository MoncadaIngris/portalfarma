@extends('plantilla.madre')
@section('titulo')
Editar Producto
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

    <form action="{{route("productos.edit",["id"=>$producto->id])}}"  method="post">
        @method("PUT")
        @csrf
            
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nombre Del Producto: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="50" type="text" id="nombre" onkeydown="return /[a-zñÑ ]/i.test(event.key)"  minlength="3"
                 name="nombre" required="required" class="form-control"
                    @if(old("nombre"))
                    value="{{old("nombre")}}"
                    @else
                    value="{{$producto->nombre}}"
                    @endif>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Código: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input maxlength="8" type="text" id="codigo" name="codigo" required="required" class="form-control"
                    @if(old("codigo"))
                    value="{{old("codigo")}}"
                    @else
                    value="{{$producto->codigo}}"
                    @endif>
            </div>
        </div>

        <div class="item form-group">   
           <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Concentración: <span class="required">*</span></label>   
        <div class="col-md-6 col-sm-6 ">
            <Select required="required" class="form-control" id="concentracion" name="concentracion"> 
                @foreach ($concentracion as $c)
                @if ($c->id == $producto->concentracion)
                <option style="display: none" value="{{$c->id}}">{{$c->descripcion}}</option>
                @endif
                @endforeach  
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
            @if ($producto->receta == 0)
            <option style="display: none" value="0">No</option>
            @else
            <option style="display: none" value="1">Si</option>
            @endif
            <option value="0">No</option>
            <option value="1">Si</option>
        </Select>
        </div>       
    </div>  
    <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Descripción: <span class="required">*</span>
            </label> <div class="col-md-6 col-sm-6 ">
                    <textarea maxlength="200" placeholder="Ingrese la descripcion" name="descripcion" id="descripcion"  rows="3" required="required" class="form-control"
                    >@if(old("descripcion")){{old("descripcion")}}@else{{$producto->descripcion}}@endif</textarea>

                
                

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