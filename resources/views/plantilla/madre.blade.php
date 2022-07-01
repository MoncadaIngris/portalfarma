 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/diseno.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link href="{{ asset('css/bootstrapcdn.css') }}" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/selectsearch.js') }}"></script>
    <script src="{{ asset('js/impresiones.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>

    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="jspdf.debug.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
  </head>
  <body class="nav-md">
    <div class="container body">
      @yield('impresiones')
      <div class="main_container">
        <div class="col-md-3 left_col" >
          <div class="left_col" style="height: 100vh">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-heartbeat"></i> <span>Portal Farma</span></a>
            </div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset(Auth()->user()->empleados->fotografia) }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <div>
                  @forelse (auth()->user()->getRoleNames() as $roles)
                <span>{{$roles}}</span>
                @empty
                    Sin funciones
                @endforelse
                </div>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <style>
              #sidebar-menu{
                width:100%;
                height:70%;
                overflow: auto;
              }
              #sidebar-menu::-webkit-scrollbar {
                width: 12px;               /* width of the entire scrollbar */
              }

              #sidebar-menu::-webkit-scrollbar-track {
                background: #2A3F54;        /* color of the tracking area */
              }

              #sidebar-menu::-webkit-scrollbar-thumb {
                background-color: #416f9c;    /* color of the scroll thumb */
                border-radius: 20px;       /* roundness of the scroll thumb */
                border: 3px solid #102e4d;  /* creates padding around scroll thumb */
              }
            </style>

            <!-- sidebar menu -->
            <div id="sidebar-menu" >
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @can('clientes_index', 'clientes_nuevo', 'empleados_desactivados')
                  <li><a><i class="fa fa-user-circle"></i> Empleado <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('clientes_nuevo')
                      <li><a href="{{route('empleados.create')}}">Nuevo Empleado</a></li>
                      @endcan
                      @can('clientes_index')
                      <li><a href="{{route('empleados.index')}}">Empleados Activos</a></li>
                      @endcan
                      @can('empleados_desactivados')
                      <li><a href="{{route('empleados.desactivado')}}">Empleados Desactivados</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('proveedores_index','proveedores_nuevo','proveedores_desactivados')
                  <li><a><i class="fa-solid fa-box-open"></i> Proveedores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('proveedores_nuevo')
                      <li><a href="{{route('proveedor.create')}}">Nuevo Proveedor</a></li>
                      @endcan
                     @can('proveedores_index')
                     <li><a href="{{route('proveedor.index')}}">Proveedores Activos</a></li>
                     @endcan
                      @can('proveedores_desactivados')
                      <li><a href="{{route('proveedor.desactivado')}}">Proveedores Desactivados</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                @can('productos_nuevo', 'productos_index')
                <li><a><i class="fa-solid fa-box-archive"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    @can('productos_nuevo')
                    <li><a href="{{route('productos.create')}}">Nuevo Producto</a></li>
                    @endcan
                    @can('productos_index')
                    <li><a href="{{route('productos.index')}}"> Lista De Productos</a></li>
                    @endcan
                  </ul>
                </li>
                @endcan
                  @can('compras_index','compras_nuevo')
                  <li><a><i class="fa-solid fa-warehouse"></i> Compras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('compras_nuevo')
                      <li><a href="{{route('compras.create')}}">Nueva Compra</a></li>
                      @endcan
                      @can('compras_index')
                      <li><a href="{{route('compras.index')}}">Listado de Compras</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('inventarios_index')
                  <li><a><i class="fa-solid fa-people-carry-box"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('inventario')}}">Listado de Inventario</a></li>
                    </ul>
                  </li>
                  @endcan
                  @can('clientes_index','clientes_nuevo')
                  <li><a><i class="fa-solid fa-user-clock"></i>Clientes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('clientes_nuevo')
                      <li><a href="{{route('clientes.create')}}">Nuevo cliente</a></li>
                      @endcan
                      @can('clientes_index')
                      <li><a href="{{route('clientes.index')}}"> Lista De clientes</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('ventas_index','ventas_nuevo')
                  <li><a><i class="fa-solid fa-box-open"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @can('ventas_nuevo')
                      <li><a href="{{route('ventas.create')}}">Nueva venta</a></li>
                      @endcan
                      @can('ventas_index')
                      <li><a href="{{route('ventas.index')}}">Listado de Ventas</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('entrada_salida')
                  <li><a href="{{route('kardex')}}"><i class="fa-solid fa-box-open"></i>Entradas y Salidas</a></li>
                  @endcan
                  @can('grafico_cliente','grafico_producto','grafico_proveedor','grafico_fecha')
                  <li><a><i class="fa-solid fa-box-open"></i> Gráficos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @can('grafico_producto')
                        <li><a href="{{route('grafico.producto',['val'=>0])}}">Gráfico De Producto</a></li>
                        @endcan
                        @can('grafico_proveedor')
                        <li><a href="{{route('grafico.proveedor',['val'=>0])}}">Gráfico De Proveedor</a></li>
                        @endcan
                      @can('grafico_cliente')
                      <li><a href="{{route('grafico.index')}}">Gráfico De Cliente</a></li>
                      @endcan
                      @can('grafico_fecha')
                      <li><a href="{{route('grafico.ventas')}}">Gráfico De Ventas Por Fecha</a></li>
                      @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('permisos_index','permisos_nuevo')
                  <li><a><i class="fa-solid fa-box-open"></i> Permisos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li>
                      @can('permisos_nuevo')
                      <a href="{{route('permisos.create')}}">Nuevo Permiso</a>
                      @endcan
                    </li>
                    <li>
                      @can('permisos_index')
                      <a href="{{route('permisos.index')}}">Lista De Permiso</a>
                      @endcan
                    </li>
                    </ul>
                    </li>
                  @endcan
                    @can('roles_index','roles_nuevo')
                    <li><a><i class="fa-solid fa-box-open"></i> Funciones <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li>
                        @can('roles_nuevo')
                        <a href="{{route('roles.create')}}">Nueva función</a>
                        @endcan
                      </li>
                      <li>
                        @can('roles_index')
                        <a href="{{route('roles.index')}}">Lista De Funciones</a>
                        @endcan
                      </li>
                      </ul>
                      </li>
                    @endcan
                    @can('jornada_index','jornada_nuevo')
                    <li><a><i class="fa-solid fa-user-clock"></i>Jornada <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @can('jornada_nuevo')
                        <li><a href="{{route('jornada.create')}}">Nueva jornada</a></li>
                        @endcan
                        @can('jornada_index')
                        <li><a href="{{route('jornada.index')}}"> Lista De jornadas</a></li>
                        @endcan
                      </ul>
                    </li>
                       @endcan

                    @can('calendario_index','calendario_nuevo')
                    <li><a><i class="fa-solid fa-user-clock"></i>Calendario <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @can('calendario_nuevo')
                        <li><a href="{{route('calendario.create')}}">Nuevo Turno</a></li>
                        @endcan
                        @can('calendario_index')
                        <li><a href="{{route('calendario.index')}}">Listado De Turnos</a></li>
                        @endcan
                      </ul>
                    </li>
                    @endcan
                    @can('Laboral_index')
                          <li><a><i class="fa-solid fa-user-clock"></i>Laboral <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                  @can('laboral_index')
                                      <li><a href="{{route('laboral.index')}}">Estado Laboral</a></li>
                                  @endcan
                              </ul>
                                      @endcan

                    @can('usuarios_index','usuarios_nuevo')
                    <li><a><i class="fa-solid fa-user-clock"></i>Usuarios <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @can('usuarios_nuevo')
                        <li><a href="{{route('registrar')}}">Nuevo Usuario</a></li>
                        @endcan
                        @can('usuarios_index')
                        <li><a href="{{route('usuarios.index')}}"> Lista De usuarios</a></li>
                        @endcan
                      </ul>
                    </li>
                    @endcan
                    @can('calendario_index')
                    <li><a href="{{route('laborales.index')}}"><i class="fa-solid fa-box-open"></i>Listado laboral</a></li>
                    @endcan
                    @can('salario_index','salario_nuevo')
                    <li><a><i class="fa-solid fa-user-clock"></i>Salario por hora <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      @can('salario_nuevo')
                        <li><a href="{{route('salariohora.create')}}">Nuevo Salario</a></li>
                        @endcan
                        @can('salario_index')
                        <li><a href="{{route('salariohora.index')}}"> Lista De Salarios</a></li>
                        @endcan
                      </ul>
                    </li>
                    @endcan
                    @can('planilla_index')
                    <li><a href="{{route('planilla.index')}}"><i class="fa-solid fa-box-open"></i>Listado de planilla</a></li>
                    @endcan
                    <li><a href="{{route('baucher.index')}}"><i class="fa-solid fa-box-open"></i>Listado de Baucher</a></li>
                    @can('baucher_general')
                    <li><a href="{{route('baucher.general')}}"><i class="fa-solid fa-box-open"></i>Listado de Baucher general</a></li>
                    @endcan
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown">
                    <button style="border: none; outline:none;font-size: 22px" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset(Auth()->user()->empleados->fotografia) }}" alt="">{{Auth()->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <button style="border: none; outline:none;text-align: left" class="dropdown-item" onclick="window.location='{{route('perfil')}}'">
                        Perfil
                      </button><br>
                      <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" style="border: none; outline:none;text-align: left" class="dropdown-item" >Cerrar sesión</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <style>
          .btn-nuevo{
            background: #4792e2;
          }
          .btn-editar{
            background: #92e3ee;
          }
          .btn-detalles{
            background: #7be2c3;
            content: " Detalles"
          }
          .btn-desactivar{
            background: #f75666;
          }
          .btn-regresar{
            background: #f8b6ed;
          }
          .btn-guardar{
            background: #bae9f0;
          }
          .btn-activar{
            background: #448edd;
          }
          .btn-limpiar{
            background: #aff8bf;
          }
        </style>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row" style="overflow:scroll;height: 89vh">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                      <h1><center>@yield('titulo')</center></h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="prueba">
                    @yield('contenido')
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('js/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ asset('js/jquery.sparkline.min.jss') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('js/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('js/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('js/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('js/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('js/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('js/date.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <script src="{{ asset('js/all.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
  </body>
</html>
