@extends('layouts.app')

@section('content')

<style>
    #container{
        height: 220px !important;
    }
    input{
        margin-top: 15px !important;
    }
    .alert-success{
        margin-top: -40px !important;
    }
</style>

<div id="container">
    <br>
  <h3>Recuperar contraseña</h3>
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    @if (session('status'))
        <div class="alert alert-success" role="alert" style="color: white">
            ¡Hemos enviado por correo electrónico su enlace de restablecimiento de contraseña!
        </div>
    @else
    
    @endif

      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">
      @error('email')
          <span class="invalid-feedback" role="alert" style="color: red">
              {{ $message }}
          </span>
      @enderror
      
      <button type="submit" class="btn btn-primary">
        Enviar correo de recuperacion
    </button>
    <a href="{{route('login')}}" style="text-decoration: none">
        <span id="forgotten"><strong>Cancelar</strong></span>
      </a>
    </div>
</form>
</div>

@endsection
