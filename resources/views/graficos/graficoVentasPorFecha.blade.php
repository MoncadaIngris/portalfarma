@extends('plantilla.madre')
@section('titulo')
Grafico De Ventas Por Fecha Portalfarma
@stop
@section('contenido')


<div id="chart.container"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
 
<script>
    var datas = <?php echo json_encode($datas) ?>

    highcharts.chart('chart.container',{
        title: {
            text: 'Incremento de nuevas ventas , 2022'
        },
        subtitle: {
            text: 'Fuente: medios de TI'
        },
xAxis: {
    categories: ['Ene','Feb','Mzo','Abr','may','jun','jul','ago','sep','oct','nov','dic']
},
yAxis: {
    title: {
        text: 'Número de nuevas ventas '
    }
},

legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},

plotOptions:{
    series:{
        allowPointSelect: true
    }
},

series: [{
    name: 'nueva venta',
    data:datas

}],
 
responsive: {
    rules:[
        {
        condition:{
            maxWidth:500
        },
chartOptions:{
    legend:{
        layout: 'horizobtal',
        align: 'center',
        vertical: 'bottom'
    }
}


    }
]
}


    })


</script>



@stop


 