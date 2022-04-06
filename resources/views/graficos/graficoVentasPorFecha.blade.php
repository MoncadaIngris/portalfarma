@extends('plantilla.madre')
@section('titulo')
Grafico De Venta Por Fecha {{date('d/m/Y',strtotime($inicio))}} al {{date('d/m/Y',strtotime($final))}}
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

<style>
    h1{
      display: none;
    }
  </style>
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

<form action="{{route('grafico.ventas')}}" method="GET">
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
    <a type="button" href="{{route('grafico.ventas')}}" class="btn btn-danger">Limpiar</a>
  </form>

<div id="grafico">
  <div id="chart">
  </div>
</div>

<script src="{{ asset('js/graficos.js') }}"></script>

<script>
    var options = {
           series: [{
           name: 'Ventas',
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
                @switch(substr($b->fecha, 5))
                    @case(01)
                    ["Enero {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(2)
                    ["Febrero {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(3)
                    ["Marzo {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(4)
                    ["Abril {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(5)
                    ["Mayo {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(6)
                    ["Junio {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(7)
                    ["Julio {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(8)
                    ["Agosto {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(9)
                    ["Septiembre {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(10)
                    ["Octubre {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(11)
                    ["Noviembre {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @case(12)
                    ["Diciembre {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                    @break
                    @default
                    ["Error {{substr($b->fecha, 0, -3)}}","{{number_format(($b->total/$suma)*100, 2, '.', '')}}%"],
                @endswitch
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
     text: 'Grafico De Venta Por Fecha {{date('d/m/Y',strtotime($inicio))}} al {{date('d/m/Y',strtotime($final))}}',
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


 