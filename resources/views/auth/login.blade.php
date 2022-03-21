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
        <span id="forgotten">Recuperar Contraseña</span>
      </div>
  </form>
  </div>
  
  <!-- Forgotten Password Container -->
  <div id="forgotten-container">
     <h1>Recuperar Contraseña</h1>
    <span class="close-btn">
      <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
    </span>
  
    <form>
      <input type="email" name="email" placeholder="Correo Electronico">
      <a href="#" class="orange-btn">Recuperar contraseña</a>
  </form>
  </div>
@stop