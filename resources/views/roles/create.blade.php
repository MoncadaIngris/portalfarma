@extends('plantilla.')
@section('titulo')
Crear Funciones
@stop
@section('contenido')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
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
        <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal">
          @csrf
          <div class="card ">
            <div class="card-body">
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Nombre del rol</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" autocomplete="off" autofocus>
                  </div>
                </div>
              </div>
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Permisos</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <div class="tab-content">
                      <div class="tab-pane active">
                        <table class="table table-bordered">
                          <tbody>
                            @foreach ($permissions as $permission)
                              <tr>
                                <td>
                                  <input class="form-check-input" type="checkbox" name="permissions[]"
                                  value="{{ $permission->id }}">
                                </td>
                                <td>{{ $permission->titulo }}</td>
                                <td>{{ $permission->name }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--End body-->

            <!--Footer-->
            <div class="item form-group">
              <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-regresar" type="button" onclick="window.location='{{route('roles.index')}}'">Cancelar</button>
                  <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Limpiar</a>
                  <button type="submit" class="btn btn-guardar">Guardar</button>
              </div>
          </div>
            <!--End footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection