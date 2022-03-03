@extends('plantilla.madre')
@section('titulo')
    Listado de compras
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('compras.create')}}'"><i class="fa-solid fa-folder-plus"></i> Nueva Compra</button>
    <div style="float: right">
        <p><center>Descargar reporte:</center></p>
        <a class="btn btn-outline-secondary" href="javascript:exportTableToExcel('imptable', 'listado_compras_{{date("d_m_Y")}}')">Excel</a>
        <a class="btn btn-outline-secondary" href="{{route('compra.pdf')}}">PDF</a>
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
            <th scope="col" style="text-align: center">Fecha efectuada</th>
            <th scope="col" style="text-align: center">Proveedor</th>
            <th scope="col" style="text-align: center">Sub Total</th>
            <th scope="col" style="text-align: center">Impuesto</th>
            <th scope="col" style="text-align: center">Total</th>
            <th scope="col" style="text-align: center">Detalle</th>

        
        
        </tr>
        </thead>

        <tbody>
        @foreach ($compras as $compra)
            <tr>
                <td>{{date_format($compra->created_at,"d/m/Y")}}</td>
                <td>{{$compra->proveedores->nombre_proveedor}}</td>
                <td style="text-align: right">L.{{ number_format($compra->subtotal,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->impuesto,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
                <td>
                    <center>
                        <a class="btn btn-detalles" href="{{route("compras.show",["id"=>$compra->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @section('impresiones')
<div style="display: none" id="divtable">
    <br><br><br>
    <h2><center><strong>Listado de compras {{date("d/m/Y")}}</strong></center></h2>
    <table  id="imptable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Fecha efectuada</th>
            <th scope="col" style="text-align: center">Proveedor</th>
            <th scope="col" style="text-align: center">Sub Total</th>
            <th scope="col" style="text-align: center">Impuesto</th>
            <th scope="col" style="text-align: center">Total</th>

        
        
        </tr>
        </thead>

        <tbody>
        @foreach ($compras as $compra)
            <tr>
                <td>{{date_format($compra->created_at,"d/m/Y")}}</td>
                <td>{{$compra->proveedores->nombre_proveedor}}</td>
                <td style="text-align: right">L.{{ number_format($compra->subtotal,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->impuesto,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>
@stop

@stop
