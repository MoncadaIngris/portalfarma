@extends('plantilla.madre')
@section('titulo')
Perfil del usuario: {{auth()->user()->name}}
@stop
@section('contenido')

@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif

<div style="float: left;width: 16%">
<img src="{{asset(auth()->user()->empleados->fotografia)}}" width="100%" height="100%" alt="">
</div>

<div style="float: left;width: 40%;margin-left: 2%">

    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Nombres: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->nombres}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Correo electronico: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->correo_electronico}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Telefono alternativo: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->telefono_alternativo}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Fecha de ingreso: </label>
        <input style="float: left;width: 60%;" type="date" class="form-control" value="{{auth()->user()->empleados->fecha_de_ingreso}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Direccion: </label>
        <textarea style="float: left;width: 60%;" name="" id="" cols="30" rows="3" class="form-control" disabled >{{auth()->user()->empleados->direccion}}</textarea>
    </div>

</div>

<div style="float: left;width: 40%;margin-left: 2%">

    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Apellidos: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->apellidos}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Identidad: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->DNI}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Telefono personal: </label>
        <input style="float: left;width: 60%;" type="text" class="form-control" value="{{auth()->user()->empleados->telefono_personal}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Fecha de nacimiento: </label>
        <input style="float: left;width: 60%;" type="date" class="form-control" value="{{auth()->user()->empleados->fecha_de_nacimiento}}" disabled>
    </div>
    <br><br><br>
    <div>
        <label style="float: left;width: 40%;line-height: 35px" for="">Funcion: </label>
        <?php $i = 1?>
        <textarea style="float: left;width: 60%;" name="" id="" cols="30" rows="3" class="form-control" disabled >@forelse (auth()->user()->getRoleNames() as $roles) {{$i}}. {{$roles}}  <?php $i ++?>

@empty Sin funciones @endforelse
        </textarea>
    </div>

</div>

<div style="float: left;width:100%">
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <a style="color: black" href="{{route('perfil.editar')}}" type="button" class="btn btn-guardar">Editar datos</a>
            <a style="color: whitesmoke" href="{{route('perfil.nueva_contrasenia')}}" type="button" class="btn btn-dark">Editar contraseña</a>
            <button class="btn btn-regresar" type="button" onclick="window.location='{{route('welcome')}}'">Regresar</button>
        </div>
    </div>
</div>

@stop
