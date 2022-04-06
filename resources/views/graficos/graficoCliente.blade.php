@extends('plantilla.madre')
@section('titulo')
Grafico De Venta Por Clientes {{date('d/m/Y',strtotime($inicio))}} al {{date('d/m/Y',strtotime($final))}}
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

<form action="{{route('grafico.index')}}" method="GET">
    <div class="row">
      <center>
        <div style="width: 45%;float: left;margin-left: 2%">
          <div>
            <label for="">Fecha Inicio:</label>
            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <div>
            <input type="date" class="form-control" id="start_date" name="start_date"  value="{{date("Y-m-d", strtotime($inicio))}}"
          >
          </div>
        </div>
        <div style="width: 45%;float: left;margin-left: 6%">
          <div>
            <label for="">Fecha Final:</label>
            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <div>
            <input type="date" class="form-control" id="end_date" name="end_date"  value="{{date("Y-m-d", strtotime($final))}}"
            >
          </div>
        </div>
      </center>
    </div>
    <br>
    <button class="btn btn-success" type="submit">Filtrar</button>
    <a type="button" href="{{route('grafico.index',['val' => $val])}}" class="btn btn-danger">Limpiar</a>
  @if ($val == 0)
    <a type="button" href="{{route('grafico.index',['val' => 1, 'end_date' => $final, 'start_date' => $inicio])}}" class="btn btn-warning">Ver tabla</a>
  @else
    <a type="button" href="{{route('grafico.index',['val' => 0, 'end_date' => $final, 'start_date' => $inicio])}}" class="btn btn-warning">Ver grafico</a>
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
            <th scope="col" class="sorting" style="text-align: center">Clientes</th>
            <th scope="col" class="sorting" style="text-align: center">Vendido</th>
            <th scope="col" class="sorting" style="text-align: center">Porcentaje</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ventas2 as $p)
            <tr>
                <td>{{$p->nombres}} {{$p->apellidos}}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{ asset('js/graficos.js') }}"></script>

<script>
    var options = {
           series: [{
           name: 'Clientes',
           data: [
             @foreach ($ventas as $b)
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
             @foreach ($ventas as $b)
               ["{{$b->nombres}} {{$b->apellidos}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
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
     text: 'Gráfico de ventas por Cliente',
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