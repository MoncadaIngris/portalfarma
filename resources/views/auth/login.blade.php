@extends('layouts.app')

@section('content')
  <div id="container">
      <br>
    <h3>Iniciar Sesion</h3>
  
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Correo electronico">
        @error('email')
            <span class="invalid-feedback" role="alert" style="color: red">
                {{ $message }}
            </span>
        @enderror
        <input type="password" name="password" placeholder="Contraseña">
        @error('password')
            <span class="invalid-feedback" role="alert" style="color: red">
                {{ $message }}
            </span>
        @enderror
        <br>
      <button type="submit">Iniciar Sesion</button>
      <div id="remember-container">
<a href="{{route('password.request')}}" style="text-decoration: none">
  <span id="forgotten"><strong>Recuperar Contraseña</strong></span>
</a>

      </div>
  </form>
  </div>

@stop