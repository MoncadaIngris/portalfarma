<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <h3><center>{{ $title }} {{ $date }}</center></h3>

    <table class="table table-striped">
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
        @foreach ($ventas as $venta)
            <tr>
                <td>{{date_format($venta->created_at,"d/m/Y")}}</td>
                <td>{{$venta->nombre_proveedor}}</td>
                <td style="text-align: right">L.{{ number_format($venta->subtotal,2)}}</td>
                <td style="text-align: right">L.{{ number_format($venta->impuesto,2)}}</td>
                <td style="text-align: right">L.{{ number_format($venta->total,2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>
