<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <h3><center>{{ $title }} {{ $date }}</center></h3>
    
    <table  id="datatable" class="table table-striped">
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

</body>
</html>