<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portalfarma|Cambio de Clave</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>
<center>
    <body style="width: 50%;margin: 0 auto;">
        <br><br><br>
        <form role="form" id="Formulario" action="" method="POST" enctype="multipart/form-data">
    
            @csrf
        
            <h1><strong><center>Cambio de Clave</center></strong></h1>
        
            <div >
                <label for="password" >{{ __('Nueva Contraseña:') }}</label>
        
                <div class="mb-3">
                    <input placeholder="ingrese su nueva contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
                <div >
                <label for="password-confirm" >{{ __('Confirme su nueva contraseña:') }}</label>
        
                <div class="mb-3">
                    <input placeholder="Confirme su contraseña"  id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
        
            <div class="mb-3">
                    <button type="submit" class="btn btn-info">
                        {{ __('Cambiar') }}
                    </button>
        
                    
            </div>
        
        </form>
    </body>
</center>
</html>