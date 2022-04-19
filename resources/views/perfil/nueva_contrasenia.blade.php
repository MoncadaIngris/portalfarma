@extends('plantilla.madre')
@section('titulo')
    Cambiar contraseña de: {{auth()->user()->name}}
@stop
@section('contenido')

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    <div> <br> <br>

        <center>
            <form role="form" id="Formulario" action="" method="POST" enctype="multipart/form-data">
                @csrf

                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach

                <div class="form-group row">
                    <label for="current_password" class="col-sm-2 col-form-label">{{ __('Contraseña actual:') }}</label>
                    <div class="col-sm-5">
                        <input placeholder="" id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">{{ __('Nueva contraseña:') }}</label>
                    <div class="col-sm-5">
                        <input placeholder="" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm_password" class="col-sm-2 col-form-label">{{ __('Confirmar contraseña:') }}</label>
                    <div class="col-sm-5">
                        <input placeholder="" id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">

                        @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('perfil')}}'">
                        {{ __('Regresar') }}
                    </button>
                    <button type="submit" class="btn btn-info">
                        {{ __('Cambiar') }}
                    </button>
                </div>

            </form>
        </center>
    </div>
@stop

