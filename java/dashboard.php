<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
?>
load_data();
function load_data(){
    var idu = <?php echo $id_user;?>;
    $.ajax({
        type: "GET",
        url: '../json/consult.php?action=4&idu='+idu, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var ingreso = registro.ingreso;
                var egreso = registro.Egresos;
                var utilidad = registro.utilidad;
                if (!ingreso) {
                    ingreso = 0 + ' K';
                }
                if (!egreso) {
                    egreso = 0 + ' K';
                }
                if (!utilidad) {
                    utilidad = 0 + ' K';
                }
                if (ingreso >= 1000 && ingreso < 1000000){
                    ingreso = ingreso / 1000 + " K";
                } else if (ingreso >= 1000000){
                    ingreso = ingreso / 1000000 + " M";
                }
                if (egreso <= -1000 && egreso > -1000000){
                    egreso = egreso / 1000 + " K";
                } else if (egreso <= -1000000){
                    egreso = egreso / 1000000 + " M";
                }
                if (utilidad >= 1000 && utilidad < 1000000){
                    utilidad = utilidad / 1000 + " K";
                } else if (utilidad >= 1000000){
                    utilidad = utilidad / 1000000 + " M";
                } else if (utilidad <= -1000 && utilidad > -1000000){
                    utilidad = utilidad / 1000 + " K";
                } else if (utilidad <= -1000000){
                    utilidad = utilidad / 1000000 + " M";
                }
                $("#lbl_ingreso").append("<h2 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+ingreso+"</h2>");
                $("#lbl_egreso").append("<h2 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+egreso+"</h2>");
                $("#lbl_utilidad").append("<h2 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+utilidad+"</h2>");
            });   
        },
        error: function(data) {
            console.log(data);
            $.each(data,function(key, registro) {
                $("#lbl_ingreso").append("<h2 class='text-dark mb-1 font-weight-medium'>0 K</h2>");
                $("#lbl_egreso").append("<h2 class='text-dark mb-1 font-weight-medium'>0 K</h2>");
                $("#lbl_utilidad").append("<h2 class='text-dark mb-1 font-weight-medium'>0 K</h2>");
            });  
        }
    });
};
var idu = <?php echo $id_user;?>;
$.ajax({
    type: "GET",
    url: '../json/grafica.php?action=1&idu='+ idu, 
    dataType: "json",
    success: function(data){
        //console.log(data);
        var data2 = {};
        var value = [];
        JSON.parse(JSON.stringify(data)).forEach(function(d) {
            data2[d.categoria] = d.cantidad;
            value.push(d.categoria);
        });
        //console.log(data2);
        var chart1 = c3.generate({
        bindto: '#campaign-v2',
        data: {
            json: [data2],
            keys: {
                value: value
            },

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'Ingresos',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#5f76e8',
                '#ff4f70',
                '#01caf1',
                '#ff7f0e',
                '#ffbb78',
                '#2ca02c',
                '#98df8a',
                '#d62728',
                '#ff9896',
                '#9467bd',
                '#c5b0d5',
                '#8c564b',
                '#c49c94',
                '#e377c2',
                '#f7b6d2',
                '#7f7f7f',
                '#c7c7c7',
                '#bcbd22',
                '#dbdb8d',
                '#17becf',
                '#9edae5'
            ]
        }
        });
    },
    error: function (data) {
        var chart1 = c3.generate({
        bindto: '#campaign-v2',
        data: {
            columns: [
                ['Sin ingresos', 1],
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'Ingresos',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#edf2f6'
            ]
        }
        });
    }
});

$.ajax({
    type: "GET",
    url: '../json/grafica.php?action=2&idu='+ idu, 
    dataType: "json",
    success: function(data){
        console.log(data);
        var data2 = {};
        var value = [];
        JSON.parse(JSON.stringify(data)).forEach(function(d) {
            data2[d.categoria] = d.cantidad;
            value.push(d.categoria);
        });
        console.log(data2);
        var chart1 = c3.generate({
        bindto: '#campaign-v3',
        data: {
            json: [data2],
            keys: {
                value: value
            },

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'Egresos',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#5f76e8',
                '#ff4f70',
                '#01caf1',
                '#ff7f0e',
                '#ffbb78',
                '#2ca02c',
                '#98df8a',
                '#d62728',
                '#ff9896',
                '#9467bd',
                '#c5b0d5',
                '#8c564b',
                '#c49c94',
                '#e377c2',
                '#f7b6d2',
                '#7f7f7f',
                '#c7c7c7',
                '#bcbd22',
                '#dbdb8d',
                '#17becf',
                '#9edae5'
            ]
        }
        });
    },
    error: function (data) {
        var chart1 = c3.generate({
        bindto: '#campaign-v3',
        data: {
            columns: [
                ['Sin egresos', 1],
            ],

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'Egresos',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: [
                '#edf2f6'
            ]
        }
        });
    }
});
 d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');
 d3.select('#campaign-v3 .c3-chart-arcs-title').style('font-family', 'Rubik');
