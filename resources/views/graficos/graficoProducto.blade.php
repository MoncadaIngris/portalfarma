@extends('plantilla.madre')
@section('titulo')
  Estadisticas de ventas por Producto {{date('d/m/Y',strtotime($inicio))}} al {{date('d/m/Y',strtotime($final))}}
@stop
@section('contenido')

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

@if($val == 0)
<style>
  h1{
    display: none;
  }
</style>
@else
<style>
  #prueba {
      overflow:auto;
  }
  .dt-buttons{
      float: right !important;
  }
</style>
@endif
<script>

  var colors = [
      '#008FFB',
      '#FF4560',
      '#26a69a',
      '#546E7A',
      '#775DD0',
      '#D10CE8',
      '#FEB019',
      '#00E396',
    ]

</script>

<?php $fecha_actual = date("Y-m-d");?>

<form action="{{route('grafico.producto')}}" method="GET">
  <div class="row">
    <center>
      <div style="width: 45%;float: left;margin-left: 2%">
        <div>
          <label for="">Fecha Inicio:</label>
          <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
        </div>
        <div>
          <input type="date" class="form-control" id="start_date" name="start_date"  value="{{date("Y-m-d", strtotime($inicio))}}"
          min="<?php echo date('Y-m-d',strtotime($inicio));?>"
          max="<?php echo date('Y-m-d',strtotime($final));?>">
        </div>
      </div>
      <div style="width: 45%;float: left;margin-left: 6%">
        <div>
          <label for="">Fecha Final:</label>
          <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
        </div>
        <div>
          <input type="date" class="form-control" id="end_date" name="end_date"  value="{{date("Y-m-d", strtotime($final))}}"
          min="<?php echo date('Y-m-d',strtotime($inicio));?>"
            max="<?php echo date('Y-m-d',strtotime($final));?>">
        </div>
      </div>
    </center>
  </div>
  <br>
  <button class="btn btn-success" type="submit">Filtrar</button>
  <a type="button" href="{{route('grafico.producto',['val' => $val])}}" class="btn btn-danger">Limpiar</a>
@if ($val == 0)
  <a type="button" href="{{route('grafico.producto',['val' => 1, 'end_date' => $final, 'start_date' => $inicio])}}" class="btn btn-warning">Ver tabla</a>
@else
  <a type="button" href="{{route('grafico.producto',['val' => 0, 'end_date' => $final, 'start_date' => $inicio])}}" class="btn btn-warning">Ver grafico</a>
  <br><br>
@endif
</form>


@if($val == 1)
<div id="tabla">
    <div style="float: right;margin-right: 10px; width: 250px">
        <p><center>Descargar reporte:</center></p>
    </div>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Producto</th>
            <th scope="col" class="sorting" style="text-align: center">Vendido</th>
            <th scope="col" class="sorting" style="text-align: center">Porcentaje</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($productos2 as $p)
            <tr>
                <td>{{$p->nombre}}</td>
                <td style="text-align: right">L.{{ number_format($p->total,2)}}</td>
                <td style="text-align: right">{{number_format(($p->total/$suma)*100, 2, '.', '')}}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@else
<div id="grafico">
  <div id="chart">
  </div>
</div>
@endif
<script src="{{ asset('js/graficos.js') }}"></script>

<script>
   var options = {
          series: [{
          name: 'Ventas',
          data: [
            @foreach ($productos as $b)
            {{$b->total}},
            @endforeach
          ]
        }],
          chart: {
          height: 400,
          type: 'bar',
          events: {
            click: function(chart, w, e) {

            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            @foreach ($productos as $b)
              ["{{$b->nombre}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
            @endforeach
          ],
          labels: {
            style: {
              colors: colors,
              fontSize: '16px'
            }
          }
        },
        title: {
    text: 'Gráfico de ventas por Producto {{date('d/m/Y',strtotime($inicio))}} al {{date('d/m/Y',strtotime($final))}}',
    floating: false,
    align: 'center',
    style: {
      color: '#444',
      fontSize: '30px',
    }
  }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>
@stop
