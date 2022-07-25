@extends('plantilla.')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@section('titulo')
    Bienvenido {{auth()->user()->name}}
@stop
@section('contenido')
@if(session('denegar'))
<div id="mensaje" class="alert alert-danger">
    {{session('denegar')}}
</div>
@endif

<div class="container overflow-hidden">
    <div class="row gx-5">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="images/banner_empleados.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h3 class="card-title" style="text-align: center">Empleados</h3>
                <p class="card-text">Existen {{$empleado}} empleados en los registros.</p>
                <a href="/empleados/nuevo" class="btn btn-primary">Añadir</a>
                <a href="/empleados" class="btn btn-success">Listar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="images/banner_proveedores.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center">Proveedores</h3>
                    <p class="card-text">Existen {{$proveedores}} proveedores en los registros.</p>
                    <a href="/proveedor/nuevo" class="btn btn-primary">Añadir</a>
                    <a href="/proveedor" class="btn btn-success">Listar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="images/banner_clientes.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center">Clientes</h3>
                    <p class="card-text">Existen {{$clientes}} clientes en los registros.</p>
                    <a href="clientes/nuevo" class="btn btn-primary">Añadir</a>
                    <a href="/clientes" class="btn btn-success">Listar</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="images/banner_productos.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center">Productos</h3>
                    <p class="card-text">Existen {{$productos}} productos en los registros.</p>
                    <a href="/productos/nuevo" class="btn btn-primary">Añadir</a>
                    <a href="/productos" class="btn btn-success">Listar</a>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<hr>

</div>
    <footer id="footer"><a href="#"> PortalFarma © </a> 2022-2023 Todos los derechos reservados.Versión x.x.x</footer>
</div>
@stop
