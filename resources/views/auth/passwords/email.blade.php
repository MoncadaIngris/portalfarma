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

      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Correo electrónico">
        @if($errors->has('email'))
          <span class="invalid-feedback" role="alert" style="color: rgb(216, 88, 88);font-size: 14px">
            @if ($errors->first('email') == 'El campo email es requerido.')
            <strong><center>El campo correo electrónico es requerido.</center></strong>
            @else
            <strong><center>{{$errors->first('email')}}</center></strong>
            @endif
            
          </span>
        @else
        <br>
        @endif
      
      <button type="submit" class="btn btn-primary">
        Enviar correo de recuperación
    </button>
    <a href="{{route('login')}}" style="text-decoration: none">
        <span id="forgotten style="color: white"><strong>Cancelar</strong></span>
      </a>
    </div>
</form>
</div>

@endsection
