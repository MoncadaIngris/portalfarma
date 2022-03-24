@extends('plantilla.madre')
@section('titulo')
Grafico De Ventas Por Fecha Portalfarma
@stop
@section('contenido')


<div class="container mt-5">
      <div class="row">
          <div class="col">
              <div id="container">
                  
              </div>
          </div>
      </div>
      </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
  
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
  

    xAxis: {
        type: 'categoria'
    },
    yAxis: {
        title: {
            text: 'Cantidad'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:18px">{series.name}<br></span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span><br>: Cantidad vendida en esta fecha = <b>{point.y:.2f}%</b><br/>'
    },

    series: [
        {
            name: "Fecha de la venta:",
            colorByPoint: true,
            data: <?=$data ?>

        }]
    
});
             
          

</script>

@stop



 