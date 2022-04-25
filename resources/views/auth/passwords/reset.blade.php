@extends('layouts.app')

@section('content')


<style>
    #container{
        height: 340px !important;
    }
    input{
        margin-top: 15px !important;
    }
    .alert-success{
        margin-top: -40px !important;
    }
    label{
        color: rgb(0, 0, 0) !important;
    }
</style>

<div id="container">
    <br>
  <h3>Restablecer contraseña</h3>
  <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input readonly style="display: none" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

    @error('email')
        <span class="invalid-feedback" role="alert" style="color: rgb(216, 88, 88)">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <center><label for=""><strong>Ingrese su nueva contraseña:</strong> </label></center>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
    @if($errors->has('password'))
    @if ($errors->first('password')=='El campo password es requerido.')
            <strong style="margin-left: 10%;color: rgb(216, 88, 88)">El campo contraseña es requerido.</strong>
        @else
            <strong style="margin-left: 10%;color: rgb(216, 88, 88)">{{$errors->first('password')}}</strong>
        @endif
    @else
        <br>
    @endif

    <center><label for=""><strong>Vuelva a ingresar su nueva contraseña: </strong></label></center>
    <input id="password-confirm"  type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">

    
      
    <button type="submit" class="btn btn-primary">
        {{ __('Cambiar contraseña') }}
    </button>
    <a href="{{route('login')}}" style="text-decoration: none">
        <span id="forgotten"><strong>Cancelar</strong></span>
      </a>
    </div>
</form>
</div>


@endsection
