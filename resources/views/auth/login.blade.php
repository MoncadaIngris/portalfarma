@extends('layouts.app')

@section('content')
  <div id="container">
      <br>
    <h3>Iniciar Sesión</h3>
  
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Correo electrónico">
          @if($errors->has('email'))
                @if ($errors->first('email')=='El campo email es requerido.')
                  <strong style="margin-left: 10%;color: rgb(216, 88, 88)">Correo electrónico incorrecto</strong>
                @else
                <strong style="margin-left: 10%;color: rgb(216, 88, 88)">{{$errors->first('email')}}</strong>
                @endif
          @else
          <br>
          @endif
        <input type="password" name="password" placeholder="Contraseña">
          @if($errors->has('password'))
                <strong style="margin-left: 10%;color: rgb(216, 88, 88)">Contraseña incorrecta</strong>
                @else
          <br>
          @endif

      <button type="submit">Iniciar Sesión</button>
      <div id="remember-container">
<a href="{{route('password.request')}}" style="text-decoration: none">
  <span id="forgotten"  ><strong>Recuperar Contraseña</strong> </span>
</a>

      </div>
  </form>
  </div>

@stop