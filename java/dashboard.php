<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
$divisa_primary = "\"".$_SESSION["divisa"]."\"";
?>
load_data(1);
var idu = <?php echo $id_user;?>;
val_session(idu);
val_new_user(idu);
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

function load_data(reload){ // 1 to reload divisas and 0 to not reaload
    var idu = <?php echo $id_user;?>;
    document.getElementById("balance").innerHTML = "";
    if (reload == 1){
        var divisa_primary = <?php echo $divisa_primary;?>;
        document.getElementById("select_divisa").innerHTML = "";
    } else {
        var divisa_primary = document.getElementById("select_divisa").value;
    }
    $.ajax({
        type: "GET",
        url: '../json/consult.php?action=4&idu='+idu, 
        dataType: "json",
        success: function(data){
            document.getElementById("balance").innerHTML = "";
            $("#balance").append("<a class='dropdown-item' href='/pages/profile.php'><i "+
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
                if (reload == 1){
                    if (divisa_primary == registro.divisa){
                        $('#select_divisa').append("<option selected value='"+registro.divisa+"'>"+registro.divisa+"</option>");
                    } else {
                        $('#select_divisa').append("<option value='"+registro.divisa+"'>"+registro.divisa+"</option>");
                    }
                }
            });
            $("#balance").append("<div class='dropdown-divider'></div>"+
                "<a class='dropdown-item' href='/'><i "+
                " class='fas fa-power-off mr-2 ml-1'></i>"+
                "Logout</a>"
            );
        }
    });
    load_card(divisa_primary);
};
function load_card(divisa_primary){
    var idu = <?php echo $id_user;?>;
    document.getElementById("lbl_ingreso").innerHTML = "";
    document.getElementById("lbl_egreso").innerHTML = "";
    document.getElementById("lbl_utilidad").innerHTML = "";
    document.getElementById("lbl_ahorros").innerHTML = "";
    $.ajax({
        type: "GET",
        url: '../json/consult.php?action=5&idu='+idu+'&divi='+divisa_primary, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var ingreso = registro.ingreso;
                var egreso = registro.Egresos;
                var utilidad = registro.utilidad;
                if (!ingreso) {
                    ingreso = 0.00;
                }
                if (!egreso) {
                    egreso = 0.00;
                }
                if (!utilidad) {
                    utilidad = 0.00;
                }
                $("#lbl_ingreso").append("<h3 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+ingreso+"</h3>");
                $("#lbl_egreso").append("<h3 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+egreso+"</h3>");
                $("#lbl_utilidad").append("<h3 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+utilidad+"</h3>");
            });   
        },
        error: function(data) {
            $("#lbl_ingreso").append("<h3 class='text-dark mb-1 font-weight-medium'>0.00</h3>");
            $("#lbl_egreso").append("<h3 class='text-dark mb-1 font-weight-medium'>0.00</h3>");
            $("#lbl_utilidad").append("<h3 class='text-dark mb-1 font-weight-medium'>0.00</h3>");
        }
    });
    $.ajax({
        type: "GET",
        url: '../json/consult.php?action=6&idu='+idu+'&divi='+divisa_primary, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                var ahorro = registro.cantidad;

                if (!ahorro) {
                    ahorro = 0.00;
                }

                $("#lbl_ahorros").append("<h3 class='text-dark mb-1 font-weight-medium'><sup " +
                    "class='set-doller'>$</sup>"+ahorro+"</h3>");
            });   
        },
        error: function(data) {
            $("#lbl_ahorros").append("<h3 class='text-dark mb-1 font-weight-medium'>0.00</h3>");
        }
    });
    view_chart(divisa_primary);
};

$('#add_move_btn').click(function(){
    getPagina("consult_cate.php", "dash_categoria");
    getPagina("consult_accont.php", "dash_cuenta");
    var now = new Date($.now())
        , year
        , month
        , date
        , hours
        , minutes
        , seconds
        , formattedDateTime
        ;

    year = now.getFullYear();
    month = now.getMonth().toString().length === 1 ? '0' + (now.getMonth() + 1).toString() : now.getMonth() + 1;
    date = now.getDate().toString().length === 1 ? '0' + (now.getDate()).toString() : now.getDate();
    hours = now.getHours().toString().length === 1 ? '0' + now.getHours().toString() : now.getHours();
    minutes = now.getMinutes().toString().length === 1 ? '0' + now.getMinutes().toString() : now.getMinutes();
    seconds = now.getSeconds().toString().length === 1 ? '0' + now.getSeconds().toString() : now.getSeconds();

    formattedDateTime = year + '-' + month + '-' + date + 'T' + hours + ':' + minutes + ':' + seconds;
    document.getElementById("dash_divisa").value = document.getElementById("select_divisa").value;
    document.getElementById("dash_fecha").value = formattedDateTime;
    $("#dash_monto_signal").click(function(){
		var signal = document.getElementById("dash_monto_signal");
		if (signal.value == "+"){
			signal.innerHTML = "-";
			signal.value = "-";
			signal.className = "btn btn-outline-danger";
		} else {
			signal.innerHTML = "+";
			signal.value = "+";
			signal.className = "btn btn-outline-success";
		}
	});

    $("#dash_trans").unbind('click').click(function(){
		var monto_signal = document.getElementById("dash_monto_signal").value;
		var valor = document.getElementById("dash_valor").value;
        var cuenta = document.getElementById("dash_cuenta").value;
		var divisa = document.getElementById("dash_divisa").value;
		var categoria = document.getElementById("dash_categoria").value;
		var descripcion = document.getElementById("dash_descripcion").value;
		var fecha = document.getElementById("dash_fecha").value;
		if (monto_signal == '-'){
			valor = valor * -1;
		}
		if (valor == "" || valor == 0 || divisa == "" || cuenta == 0 || categoria == 0 || fecha == "") {
			if (valor == "" || valor == 0){
				document.getElementById("dash_valor").className = "form-control is-invalid";
			}
			if (divisa == "") {
				document.getElementById("dash_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0 is-invalid";
			}
			if (categoria == 0) {
				document.getElementById("dash_categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
            if (cuenta == 0) {
				document.getElementById("dash_cuenta").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
			if (fecha == "") {
				document.getElementById("dash_fecha").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_transaccion.php', {
				type: 'POST',
				data: {
					cuenta: cuenta,
					valor: valor,
					divisa: divisa,
					categoria: categoria,
					descripcion: descripcion,
					fecha: fecha
				},
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalAddDash').modal('hide');
						document.getElementById("dash_valor").className = "form-control";
						document.getElementById("dash_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0";
						document.getElementById("dash_categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
                        document.getElementById("dash_cuenta").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("dash_fecha").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("dash_valor").value = "";
						document.getElementById("dash_monto_signal").value = "+";
						document.getElementById("dash_monto_signal").innerHTML = "+";
                        document.getElementById("dash_monto_signal").className = "btn btn-outline-success";
						document.getElementById("dash_divisa").value = "COP";
						document.getElementById("dash_descripcion").value = "";
                        document.getElementById("dash_cuenta").value = 0;
						document.getElementById("dash_categoria").value = 0;
                        load_data(0);
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
    $("#dash_cuenta").change(function(){
        getPagina("consult_divisa.php?id="+this.value, "dash_divisa");
    });
});
$('#add_trans_btn').click(function(){
    getPagina("consult_accont.php", "dash_trans_cuenta_fin");
    getPagina("consult_accont.php", "dash_trans_cuenta_ini");
    var now = new Date($.now())
        , year
        , month
        , date
        , hours
        , minutes
        , seconds
        , formattedDateTime
        ;

    year = now.getFullYear();
    month = now.getMonth().toString().length === 1 ? '0' + (now.getMonth() + 1).toString() : now.getMonth() + 1;
    date = now.getDate().toString().length === 1 ? '0' + (now.getDate()).toString() : now.getDate();
    hours = now.getHours().toString().length === 1 ? '0' + now.getHours().toString() : now.getHours();
    minutes = now.getMinutes().toString().length === 1 ? '0' + now.getMinutes().toString() : now.getMinutes();
    seconds = now.getSeconds().toString().length === 1 ? '0' + now.getSeconds().toString() : now.getSeconds();

    formattedDateTime = year + '-' + month + '-' + date + 'T' + hours + ':' + minutes + ':' + seconds;

    document.getElementById("dash_trans_fecha").value = formattedDateTime;
    document.getElementById("dash_divisa").value = document.getElementById("select_divisa").value;
    $("#dash_trans_monto_signal").click(function(){
		var signal = document.getElementById("dash_trans_monto_signal");
		if (signal.value == "+"){
			signal.innerHTML = "-";
			signal.value = "-";
			signal.className = "btn btn-outline-danger";
		} else {
			signal.innerHTML = "+";
			signal.value = "+";
			signal.className = "btn btn-outline-success";
		}
	});
    $("#dash_trans_trans").unbind('click').click(function(){
		var monto_signal = document.getElementById("dash_trans_monto_signal").value;
		var valor = document.getElementById("dash_trans_valor").value;
        var cuenta_ini = document.getElementById("dash_trans_cuenta_ini").value;
		var divisa = document.getElementById("dash_trans_divisa").value;
		var cuenta_fin = document.getElementById("dash_trans_cuenta_fin").value;
		var descripcion = document.getElementById("dash_trans_descripcion").value;
		var fecha = document.getElementById("dash_trans_fecha").value;
		if (monto_signal == '-'){
			valor = valor * -1;
		}
		if (valor == "" || valor == 0 || divisa == "" || cuenta_ini == 0 || cuenta_fin == 0 || fecha == "") {
			if (valor == "" || valor == 0){
				document.getElementById("dash_trans_valor").className = "form-control is-invalid";
			}
			if (divisa == "") {
				document.getElementById("dash_trans_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0 is-invalid";
			}
			if (cuenta_fin == 0) {
				document.getElementById("dash_trans_cuenta_fin").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
            if (cuenta_ini == 0) {
				document.getElementById("dash_trans_cuenta_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
			if (fecha == "") {
				document.getElementById("dash_trans_fecha").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_movi_cuenta.php', {
				type: 'POST',
				data: {
					cuenta_ini: cuenta_ini,
					valor: valor,
					divisa: divisa,
					cuenta_fin: cuenta_fin,
					descripcion: descripcion,
					fecha: fecha
				},
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalTransDash').modal('hide');
						document.getElementById("dash_trans_valor").className = "form-control";
						document.getElementById("dash_trans_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0";
						document.getElementById("dash_trans_cuenta_fin").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
                        document.getElementById("dash_trans_cuenta_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("dash_trans_fecha").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("dash_trans_valor").value = "";
						document.getElementById("dash_trans_monto_signal").value = "+";
						document.getElementById("dash_trans_monto_signal").innerHTML = "+";
						document.getElementById("dash_trans_divisa").value = "COP";
						document.getElementById("dash_trans_descripcion").value = "";
                        document.getElementById("dash_trans_cuenta_ini").value = 0;
						document.getElementById("dash_trans_cuenta_fin").value = 0;
                        load_data(0);
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
    $("#dash_trans_cuenta_ini").change(function(){
        getPagina("consult_divisa.php?id="+this.value, "dash_trans_divisa");
    });
});
function signo(id, id2){
    var nro = document.getElementById(id).value;
    var signal = document.getElementById(id2);
    if (nro < 0){
        signal.innerHTML = "-";
        signal.value = "-";
        signal.className = "btn btn-outline-danger";
        document.getElementById(id).value = nro * -1;
    }
};
function val_session(idu){
    if(idu == ""){
        window.location = "/";
    }
};

function view_chart(divisa_primary){
    var idu = <?php echo $id_user;?>;
    $.ajax({
        type: "GET",
        url: '../json/grafica.php?action=1&idu='+ idu+'&divi='+divisa_primary,
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
        url: '../json/grafica.php?action=2&idu='+ idu+'&divi='+divisa_primary, 
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

    $.ajax({
        type: "GET",
        url: '../json/grafica.php?action=3&idu='+ idu+'&divi='+divisa_primary, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            var data2 = {};
            var value = [];
            JSON.parse(JSON.stringify(data)).forEach(function(d) {
                data2[d.nombre] = d.cantidad;
                value.push(d.nombre);
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
                title: 'Ahorros',
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
    $('#movimientos-diarios').empty();
    $('#movimientos-diarios').append("<div class='d-flex align-items-start'>"+
            "<h4 class='card-title mb-0'>Movimientos Diarios</h4>"+
        "</div>"+
        "<canvas id='line-chart' height='150'></canvas>"
    );
    $.ajax({
            type: "GET",
            url: '../json/grafica.php?action=4&idu='+ idu+'&divi='+divisa_primary, 
            dataType: "json",
            success: function(data){
                //console.log(data);
                var fechas = [];
                var val_ingre = [];
                var val_egre = [];
                JSON.parse(JSON.stringify(data)).forEach(function(d) {
                    fechas.push(d.fecha);
                    val_ingre.push(d.ingresos);
                    val_egre.push(d.egresos);
                });
                new Chart(document.getElementById("line-chart"), {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{ 
                            data: val_ingre,
                            label: "Ingresos",
                            borderColor: "#22ca80",
                            fill: false
                        }, { 
                            data: val_egre,
                            label: "Egresos",
                            borderColor: "#ff4f70",
                            fill: false
                        }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        if (value < 1000000){
                                            return value / 1000 + 'k';
                                        } else {
                                            return value / 1000000 + 'M';
                                        }
                                    }
                                }
                            }]
                        }
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

    document.getElementById("activity_current").innerHTML = "";
    getPagina("consult_activity.php","activity_current");
    d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v3 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v4 .c3-chart-arcs-title').style('font-family', 'Rubik');

};

function val_new_user(idu){
    $.ajax({
        type: "GET",
        url: '../json/consult.php?action=7&idu='+idu, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            $.each(data,function(key, registro) {
                if (registro.categorias == 1 && registro.cuentas == 0){
                    $("#ModalWelcome").modal('show');
                }
            });   
        }
    }); 
}