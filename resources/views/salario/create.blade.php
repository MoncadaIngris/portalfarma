@extends('plantilla.madre')
@section('titulo')
Añadir salario hora
@stop
@section('contenido')
<div class="x_content">
    <br />
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Seleccione un cargo: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select name="jornada" id="jornada" class="form-control" required onchange="horas()">
                        <option value="" style="display: none">Seleccione una cargo</option>
                        @foreach ($cargo as $c)
                            <option value="{{$c->id}}">{{$c->descripcion}}</option>
                        @endforeach
                    </select>
                </select>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Salario semanal: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="number" class="form-control" name="semanal" id="semanal" placeholder="Ingrese el salario semanal"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                min="1" max="999999.99" maxlength="5" type="number" step="any" required title="Formato de precio incorrecto">
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Salario diario: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="diario" id="diario" value="0.00" readonly>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Salario por hora: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="hora" id="hora" value="0.00" readonly>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('salariohora.index')}}'">Cancelar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
        </div>

    </form>

    <script>
        setInterval('salario()',1000);
        function salario(){
            var semanal = document.getElementById('semanal').value;
            if (semanal != "") {
                document.getElementById('diario').value = (Math.round((semanal/6)*100))/100;
                document.getElementById('hora').value = (Math.round(((semanal/6)/8)*100))/100;
            }
        }
    </script>
</div>
@stop
