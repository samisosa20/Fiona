<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
$divisa_primary = "\"".$_SESSION["divisa"]."\"";
?>
var idu = <?php echo $id_user;?>;
var divisa_primary = <?php echo $divisa_primary;?>;
date_input();
load_data_balance();
var nro_mesajes = document.getElementById("nro_message").innerHTML;
var nro_ant_mes = 0;
getPagina("consult_divisa_repo?select=" + divisa_primary, "select_divisa");
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2
})
function load_data_balance(){
	$.ajax({
		type: "GET",
		url: '../json/consult?action=4&idu='+idu, 
		dataType: "json",
		success: function(data){
			document.getElementById("balance").innerHTML = "";
			$("#balance").append("<a class='dropdown-item' href='/pages/profile'><i "+
				" class='fas fa-user mr-2 ml-1'></i>"+
				"My Profile</a>"
			);
			$.each(data,function(key, registro) {
				var utilidad_bal = registro.utilidad_bal;
				$("#balance").append("<a class='dropdown-item row' style ='margin: 0px;'>"+
					"<i class='fas fa-credit-card mr-2 ml-1'></i>"+
					"Balance <p class='float-right'>" + utilidad_bal + " "+ registro.divisa +"</p>"+
					"</a>"
				);
			});
			$("#balance").append("<a class='dropdown-item' onclick='screen_home()'><i "+
                " class='fas fa-plus-square mr-2 ml-1'></i>"+
                "Add to home screen</a>"
            );
			$("#balance").append("<div class='dropdown-divider'></div>"+
				"<a class='dropdown-item' href='/'><i "+
				" class='fas fa-power-off mr-2 ml-1'></i>"+
				"Logout</a>"
			);
		}
	});
    getPagina("consult_nro_message", "nro_message");
    getPagina("consult_mensajes", "list_mensajes");
};
function date_input(){
    var divisa_primary = <?php echo $divisa_primary;?>;
    var now = new Date($.now())
			, year
			, month
			, date
			, formattedDateTime
			;

    year = now.getFullYear();
    month = now.getMonth().toString().length === 1 ? '0' + (now.getMonth() + 1).toString() : now.getMonth() + 1;
    date = now.getDate().toString().length === 1 ? '0' + (now.getDate()).toString() : now.getDate();

    formattedDateTime = year + '-' + month + '-' + date;

    document.getElementById("fecha_fin").value = formattedDateTime;

    now.setMonth(now.getMonth() - 1);
    year = now.getFullYear();
    month = now.getMonth().toString().length === 1 ? '0' + (now.getMonth() + 1).toString() : now.getMonth() + 1;
    date = now.getDate().toString().length === 1 ? '0' + (now.getDate()).toString() : now.getDate();

    formattedDateTime = year + '-' + month + '-' + date;
    document.getElementById("fecha_ini").value = formattedDateTime;
    view_chart(divisa_primary);
}
function getPagina(strURLop, div) {
    var xmlHttp;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        var xmlHttp = new XMLHttpRequest();
    }else if (window.ActiveXObject) { // IE
        var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.open('POST', strURLop, true);
    xmlHttp.setRequestHeader
        ('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            UpdatePage(xmlHttp.responseText, div);
        }
    }
    xmlHttp.send(strURLop);
};
function UpdatePage(str, div){
    document.getElementById(div).innerHTML = str ;
};
$("#search_report").click(function(){
    var divisa_primary = <?php echo $divisa_primary;?>;
    view_chart(divisa_primary);
})
$('#screen_android').click(function(){
    $("#ModalScreen").modal("hide");
    $("#ModalScreenAndroid").modal("show");
});
function showactivityaccount(cuenta, fecha_ini, fecha_fin){
    var idu = <?php echo $id_user;?>;
    var divisa_primary = document.getElementById("select_divisa").value;
    document.getElementById("bodyActivity").innerHTML = "";
    document.getElementById("ModalActiAccLbl").innerHTML = "Actividad de " + cuenta;
    //movimientos por cuenta
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=9&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin+'&account='+cuenta, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var cuenta = '"'+registro.nombre+'"';
            if (registro.cantidad > 0) {
                $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                        registro.categoria+"</h3>"+
                        "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                        "<p class='text-success'>"+formatter.format(registro.cantidad)+
                        "</p><p class='text-muted ml-1'></p>"+registro.fecha+"</h6>"+
                "</div>");
            } else {
                $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                        registro.categoria+"</h3>"+
                        "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                        "<p class='text-danger'>"+formatter.format(registro.cantidad)+
                        "</p><p class='text-muted ml-1'></p>"+registro.fecha+"</h6>"+
                "</div>");
            }
            });
        },
        error: function (data) {
            $("#bodyActivity").append("<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                                    "No se encontro ninguna categoria</h6>");
        }
    });
    $("#ModalActivityAccount").modal("show");
}
function showactivitycatego(categoria, fecha_ini, fecha_fin){
    var idu = <?php echo $id_user;?>;
    var divisa_primary = document.getElementById("select_divisa").value;
    document.getElementById("bodyActivity").innerHTML = "";
    document.getElementById("ModalActiAccLbl").innerHTML = "Actividad de " + categoria;
    //movimientos por categoria
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=10&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin+'&catego='+categoria, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                        registro.nombre+"</h3>"+
                        "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                        "<p class='text-danger'>"+formatter.format(registro.cantidad)+
                        "</p><p class='text-muted ml-1'></p>"+registro.fecha+"</h6>"+
                "</div>");
            });
        },
        error: function (data) {
            //console.log(data);
        }
    });
    $("#ModalActivityAccount").modal("show");
}
function showcumplipresu(categoria, mes){
    var idu = <?php echo $id_user;?>;
    var divisa_primary = document.getElementById("select_divisa").value;
    document.getElementById("bodyActivity").innerHTML = "";
    document.getElementById("ModalActiAccLbl").innerHTML = "Cumplimiento de " + categoria;
    //mCumplimiento por sub categorias
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=12&idu='+ idu+'&divi='+divisa_primary+
        '&mes='+mes+'&catego='+categoria, 
        dataType: "json",
        success: function(data){
            console.log(data);
            $.each(data,function(key, registro) {
                var grupo = registro.grupo;
                var cumpli = registro.cumplimiento;
                if ((grupo == 4 && cumpli >= 95) || ((grupo == 1 || grupo == 2) &&
                                    cumpli <= 85)) {
                    $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.categoria+" - "+registro.sub_categoria+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-success'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                } else if ((grupo == 4 && (cumpli >= 85 && cumpli < 95)) || ((grupo == 1 || grupo == 2) &&
                                    (cumpli > 85 && cumpli <= 100))) {
                    $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.categoria+" - "+registro.sub_categoria+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-warning'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                } else {
                    $("#bodyActivity").append("<div class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.categoria+" - "+registro.sub_categoria+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-danger'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                }
            });
        },
        error: function (data) {
            //console.log(data);
        }
    });
    $("#ModalActivityAccount").modal("show");
}
function view_chart(divisa_primary){
    var idu = <?php echo $id_user;?>;
    var fecha_ini = document.getElementById("fecha_ini").value;
    var fecha_fin = document.getElementById("fecha_fin").value;
    document.getElementById("resumen").innerHTML = "";
    document.getElementById("top_10").innerHTML = "";
    document.getElementById("cumplimiento").innerHTML = "";
    //Grafica Ingreso
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=2&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin,
        dataType: "json",
        success: function(data){
            //console.log(data);
            var data2 = {};
            var value = [];
            var total = 0;
            JSON.parse(JSON.stringify(data)).forEach(function(d) {
                data2[d.categoria] = d.cantidad;
                value.push(d.categoria);
                total += Number(d.cantidad);
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
                    title: 'Total '+ formatter.format(total),
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
    //Grafica Egreso
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=3&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            var data2 = {};
            var value = [];
            var total = 0;
            JSON.parse(JSON.stringify(data)).forEach(function(d) {
                data2[d.categoria] = d.cantidad;
                value.push(d.categoria);
                total += Number(d.cantidad);
            });
            //console.log(data2);
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
                title: 'Total '+ formatter.format(total),
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
    //Grafica Ahorro
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=4&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            var data2 = {};
            var value = [];
            var total = 0;
            JSON.parse(JSON.stringify(data)).forEach(function(d) {
                data2[d.nombre] = d.cantidad;
                value.push(d.nombre);
                total += Number(d.cantidad);
            });
            var chart1 = c3.generate({
            bindto: '#campaign-v4',
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
                title: 'Total '+ formatter.format(total),
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
            bindto: '#campaign-v4',
            data: {
                columns: [
                    ['Sin Ahorros', 1],
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
                title: 'Ahorros',
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
    //Resumen por cuenta
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=1&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var cuenta = '"'+registro.nombre+'"';
                var fecha_ini = '"'+document.getElementById("fecha_ini").value +'"';
                var fecha_fin = '"'+document.getElementById("fecha_fin").value +'"';
                $("#resumen").append("<div onclick='showactivityaccount("+cuenta+","+fecha_ini+","+fecha_fin+")' class='card border-botton border-right border-left'>"+
							"<div class='row'>"+
								"<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                                registro.nombre+"</h3>"+
								"<h6 class='card-title ml-3 row col-md-12 col-lg-12 col-xl-12 text-muted'>"+
                                "<p class='text-success'>"+registro.ingreso+"</p>/<p class='text-danger'>"+
                                registro.egreso+"</p></h6>"+
							"</div>"+
				"</div>");
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
    //TOP 10
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=5&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var catego = '"'+registro.categoria+'"';
                var fecha_ini = '"'+document.getElementById("fecha_ini").value +'"';
                var fecha_fin = '"'+document.getElementById("fecha_fin").value +'"';
                $("#top_10").append("<div onclick='showactivitycatego("+catego+","+fecha_ini+","+fecha_fin+")' class='card border-botton border-right border-left'>"+
                    "<div class='row'>"+
                        "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                        registro.categoria+"</h3>"+
                        "<h6 class='card-title ml-3 row col-md-12 col-lg-12 col-xl-12 text-muted'>"+
                        "<p class='text-danger'>"+registro.cantidad+"</p></h6>"+
                    "</div>"+
				"</div>");
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
    //Presupuesto
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=11&idu='+ idu+'&divi='+divisa_primary+
        '&fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var catego = '"'+registro.categoria+'"';
                var mes = registro.mes;
                var fecha_ini = '"'+document.getElementById("fecha_ini").value +'"';
                var fecha_fin = '"'+document.getElementById("fecha_fin").value +'"';
                var grupo = registro.grupo;
                var cumpli = registro.cumplimiento;
                if ((grupo == 4 && cumpli >= 95) || ((grupo == 1 || grupo == 2) &&
                                    cumpli <= 85)) {
                    $("#cumplimiento").append("<div onclick='showcumplipresu("+catego+","+mes+")' class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.name_mes+" - "+registro.categoria+"</h4>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-success'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                } else if ((grupo == 4 && (cumpli >= 85 && cumpli < 95)) || ((grupo == 1 || grupo == 2) &&
                                    (cumpli > 85 && cumpli <= 100))) {
                    $("#cumplimiento").append("<div onclick='showcumplipresu("+catego+","+mes+")' class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.name_mes+" - "+registro.categoria+"</h4>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-warning'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                } else {
                    $("#cumplimiento").append("<div onclick='showcumplipresu("+catego+","+mes+")' class='card border-botton border-right border-left'>"+
                        "<div class='row'>"+
                            "<h4 class='ml-2 mt-1 card-title col-md-10 col-lg-10 col-xl-10 text-muted'>"+
                            registro.name_mes+" - "+registro.categoria+"</h4>"+
                            "<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                            "<p class='text-danger'>"+cumpli+" %</p></h6>"+
                        "</div>"+
                    "</div>");
                }
            });
        },
        error: function (data) {
            $("#cumplimiento").append("<h6 class='card-title ml-3 row col-md-2 col-lg-2 col-xl-2 text-muted'>"+
                                    "No se encontro ningún presupuesto</h6>");
        }
    });

    d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v3 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v4 .c3-chart-arcs-title').style('font-family', 'Rubik');

};
function notificar(titulo, contenido){
    if(Notification.permission != "granted"){
        Notification.requestPermission();
    }else{
        var notification = new Notification(titulo,
            {
                icon: "http://fiona.byethost11.com/assets/images/logo-icon.png",
                body: contenido
            }
        );
    }
}
function show_mensaje(id){
    $.ajax({
        type: "GET",
        url: '../json/consult?action=8&idu='+idu+'&id='+id, 
        dataType: "json",
        success: function(data){
            $.each(data,function(key, registro) {
                document.getElementById("ModalMensaLbl").innerHTML = registro.titulo;
                document.getElementById("catego_mensaje").innerHTML = registro.tipo;
                document.getElementById("fecha_mensaje").innerHTML = registro.fecha;
                document.getElementById("contenido_mensaje").innerHTML = registro.Contenido;
            });
        }
    });
    $("#ModalMensajes").modal("show");
    $.ajax('../conexions/read_mensaje', {
        type: 'POST',
        data: {
            id: id
        },
        success: function (data, status, xhr) {
            //console.log('status: ' + status + ', data: ' + data);
        }
    });
    
}
function count_message(){
    //console.log("antes: " + nro_mesajes);
    nro_ant_mes = nro_mesajes;
    getPagina("consult_nro_message", "nro_message");
    nro_mesajes = document.getElementById("nro_message").innerHTML;
    //console.log("despues: " + nro_mesajes);
    if (nro_ant_mes < nro_mesajes && nro_ant_mes != ""){
        notificar('FIONA Notificacion', "Tienes un nuevo mensaje de fiona!");
        getPagina("consult_mensajes", "list_mensajes");
    }
    else if (nro_mesajes < nro_ant_mes){
        getPagina("consult_mensajes", "list_mensajes");
    }
};
setInterval("count_message()", 5000);