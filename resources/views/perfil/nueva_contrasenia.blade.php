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

                <label for="confirm_password" class="col-sm-4 col-form-label">{{ __('Contraseña Actual:') }}</label>
                <div class="input-group" style="width: 40%; margin-right: 1110px" >
                    <input placeholder="" id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                    <span class="input-group-btn">
                        <button id="show_current_password" class="btn btn-primary" type="button" onclick="mostrarCurrentPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                    </span>
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <label for="confirm_password" class="col-sm-4 col-form-label">{{ __('Nueva Contraseña:') }}</label>
                <div class="input-group" style="width: 40%; margin-right: 1110px" >

                    <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="password" required>
                    <span class="input-group-btn">
                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                    </span>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <label for="confirm_password" class="col-sm-4 col-form-label">{{ __('Confirmar Contraseña:') }}</label>
                <div class="input-group" style="width: 40%; margin-right: 1110px" >
                    <input placeholder="" id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                    <span class="input-group-btn">
                        <button id="show_confirm_password" class="btn btn-primary" type="button" onclick="mostrarConfirmPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                    </span>
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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

    <script type="text/javascript">
        function mostrarCurrentPassword(){
            var x = document.getElementById("current_password");
            if(x.type == "password"){
                x.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                x.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function mostrarPassword(){
            var y = document.getElementById("password");
            if(y.type == "password"){
                y.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                y.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function mostrarConfirmPassword(){
            var z = document.getElementById("confirm_password");
            if(z.type == "password"){
                z.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                z.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>
@stop

