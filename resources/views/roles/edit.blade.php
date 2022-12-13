@extends('plantilla.madre')
@section('titulo')
    Editar Funciones
@stop
@section('contenido')
    <div class="content">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-md-12">
                        <form id="form_permissions" enctype="multipart/form-data"
                              action="{{ route('roles.update', $role->id) }}"
                              method="post">
                            @method("PUT")
                            @csrf
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <label for="name" class="col-sm-2 col-form-label">Nombre del rol</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" autocomplete="off" autofocus
                                            onkeydown="return /[a-zñÑ ]/i.test(event.key)"  minlength="3" maxlength="50"
                                                   @if(old('name'))
                                                   value="{{old('name')}}"
                                                   @else
                                                   value="{{$role->name}}"
                                                @endif>
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
                                                                    <input type="checkbox"
                                                                           name="permission[]"
                                                                           id="{{ $permission->id}}" value="{{$permission->name}}"
                                                                           @if($role->permissions->contains('id',$permission->id))
                                                                           checked="checked"
                                                                        @endif >
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
                            <div class="card-footer ml-auto mr-auto">
                                <button class="btn btn-regresar" type="button" onclick="window.location='{{route('roles.index')}}'">Cancelar</button>
                                <a type="button" href="javascript:location.reload()" class="btn btn-limpiar">Restaurar</a>
                                <button type="submit" class="btn btn-guardar">Guardar</button>
                            </div>
                            <!--End footer-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
