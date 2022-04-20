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
  <h3>Recuperar contraseña</h3>
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    @if (session('status'))
        <div class="alert alert-success" role="alert" style="color: rgb(0, 0, 0)">
            <center><strong>
                ¡Hemos enviado por correo electrónico su enlace de restablecimiento de contraseña!    
            </strong></center>
        </div>
    @else
    @endif

      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">
        @if($errors->has('email'))
          <span class="invalid-feedback" role="alert" style="color: rgb(255, 0, 0);font-size: 14px">
            <strong><center>{{$errors->first('email')}}</center></strong>
          </span>
        @else
        <br>
        @endif
      
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
