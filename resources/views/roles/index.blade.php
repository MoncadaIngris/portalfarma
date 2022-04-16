@extends('plantilla.madre')
@section('titulo')
Crear Funciones
@stop
@section('contenido')
@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif
<div class="card-header pb-0">

          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @can('roles_nuevo')
                <button class="btn btn-nuevo" onclick="window.location='{{route('roles.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Función</button>
                @endcan
                <br>
              </div>
            </div>
              <table id="datatable" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                  <th class="text-center"> Nombre </th>
                  <th class="text-center" style="width: 70%"> Permisos </th>
                  <th class="text-center"> Editar </th>
                </thead>
                <tbody>
                  @forelse ($roles as $role)
                  <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                      @forelse ($role->permissions as $permission)
                          <span class="badge" style="background: rgb(241, 156, 220);color: black">{{ $permission->titulo }}</span>
                      @empty
                          <span class="badge" style="background: rgb(235, 137, 137)">Sin permiso asignados</span>
                      @endforelse
                    </td>
                    @can('roles_editar')
                    <td>
                      @if ($role->id != 1 && $role->id != 2)
                        <center>
                            <a class="btn btn-editar" href="{{ route('roles.edit', $role->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </center>
                      @endif
                  </td>
                    @endcan
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">Sin registros.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $users->links() }} --}}
          </div>



@endsection
