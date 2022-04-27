@extends('layouts.app')

@section('content')
  <div id="container">
        <form role="form" id="Formulario" action="" method="POST" enctype="multipart/form-data">
    
            @csrf
        
            <h1><strong><center>Cambio de Clave</center></strong></h1>
        <br>
            <div >
        
                <div class="mb-3">
                    <input placeholder="ingrese su nueva contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong style="margin-left: 10%;color: rgb(216, 88, 88)">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        <br>
                <div >
        
                <div class="mb-3">
                    <input placeholder="Confirme su contraseña"  id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
        <br>
            <div class="mb-3">
                    <button type="submit" class="btn btn-info">
                        {{ __('Cambiar') }}
                    </button>
        
                    
            </div>
        
        </form>
    </div>

    @stop