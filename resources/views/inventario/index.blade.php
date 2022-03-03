@extends('plantilla.madre')
@section('titulo')
    Inventario
@stop
@section('contenido')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    <style>
        #prueba {
            overflow:auto;
        }
      </style>
      <div style="float: right">
        <p><center>Descargar reporte:</center></p>
        <a class="btn btn-outline-secondary" href="javascript:exportTableToExcel('imptable', 'Inventario_{{date("d_m_Y")}}')">Excel</a>
        <a class="btn btn-outline-secondary" href="{{route('inventario.pdf')}}">PDF</a>
        <a class="btn btn-outline-secondary" id="download"> JPG </a>
        <script>
            $( "#download" ).on( "click", function() {
              document.getElementById('divtable').style.display = 'block';
              html2canvas(document.querySelector("#divtable")).then(canvas => {
                  canvas.toBlob(function(blob) {
                  window.saveAs(blob, 'Litado_de_compras_{{date("d_m_Y")}}.jpg');
                  });
                  });
              document.getElementById('divtable').style.display = 'none';
              });
        </script>
    </div>
<br><br><br><br>
      
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Producto</th>
            <th scope="col" style="text-align: center">Codigo</th>
            <th scope="col" style="text-align: center">Cantidad</th>
            <th scope="col" style="text-align: center">Precio de venta</th>
            <th scope="col" style="text-align: center">Total</th>
            <th scope="col" style="text-align: center">Detalle</th>

        
        
        </tr>
        </thead>

        <tbody>
        @foreach ($productos as $compra)
            <tr>
                <td>{{$compra->nombre}}</td>
                <td>{{$compra->codigo}}</td>
                <td style="text-align: right">{{$compra->cantidad}}</td>
                <td style="text-align: right">L.{{ number_format($compra->venta,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
                <td>
                    <center>
                        <a class="btn btn-detalles" href="{{route("inventario.show",["id"=>$compra->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop

@section('impresiones')

<div style="display: none" id="divtable">
    <br><br><br>
    <h2><center><strong>Inventario {{date("d/m/Y")}}</strong></center></h2>
    <table id="imptable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Producto</th>
            <th scope="col" style="text-align: center">Codigo</th>
            <th scope="col" style="text-align: center">Cantidad</th>
            <th scope="col" style="text-align: center">Precio de venta</th>
            <th scope="col" style="text-align: center">Total</th>
    
        
        
        </tr>
        </thead>
    
        <tbody>
        @foreach ($productos as $compra)
            <tr>
                <td>{{$compra->nombre}}</td>
                <td>{{$compra->codigo}}</td>
                <td style="text-align: right">{{$compra->cantidad}}</td>
                <td style="text-align: right">L.{{ number_format($compra->venta,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>

@stop
