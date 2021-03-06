<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
$divisa_primary = "\"".$_SESSION["divisa"]."\"";
?>
load_data(1);
var idu = <?php echo $id_user;?>;
val_session(idu);
val_new_user(idu);
var nro_mesajes = document.getElementById("nro_message").innerHTML;
var nro_ant_mes = 0;

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
                if (reload == 1){
                    if (divisa_primary == registro.divisa){
                        $('#select_divisa').append("<option selected value='"+registro.divisa+"'>"+registro.divisa+"</option>");
                    } else {
                        $('#select_divisa').append("<option value='"+registro.divisa+"'>"+registro.divisa+"</option>");
                    }
                }
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
        url: '../json/consult?action=5&idu='+idu+'&divi='+divisa_primary, 
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
        url: '../json/consult?action=6&idu='+idu+'&divi='+divisa_primary, 
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
    getPagina("consult_cate", "dash_categoria");
    getPagina("consult_accont", "dash_cuenta");
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
			$.ajax('../conexions/add_transaccion', {
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
        getPagina("consult_divisa?id="+this.value, "dash_divisa");
    });
});
$('#add_trans_btn').click(function(){
    getPagina("consult_accont", "dash_trans_cuenta_fin");
    getPagina("consult_accont", "dash_trans_cuenta_ini");
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
			$.ajax('../conexions/add_movi_cuenta', {
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
        getPagina("consult_divisa?id="+this.value, "dash_trans_divisa");
    });
});
$('#screen_android').click(function(){
    $("#ModalScreen").modal("hide");
    $("#ModalScreenAndroid").modal("show");
});
$('#screen_iphone').click(function(){
    $("#ModalScreen").modal("hide");
    $("#ModalScreenIOS").modal("show");
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
        url: '../json/grafica?action=1&idu='+ idu+'&divi='+divisa_primary,
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
        url: '../json/grafica?action=2&idu='+ idu+'&divi='+divisa_primary, 
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
        url: '../json/grafica?action=3&idu='+ idu+'&divi='+divisa_primary, 
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
            url: '../json/grafica?action=4&idu='+ idu+'&divi='+divisa_primary, 
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
    getPagina("consult_activity","activity_current");
    d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v3 .c3-chart-arcs-title').style('font-family', 'Rubik');
    d3.select('#campaign-v4 .c3-chart-arcs-title').style('font-family', 'Rubik');

};

function val_new_user(idu){
    $.ajax({
        type: "GET",
        url: '../json/consult?action=7&idu='+idu, 
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
};
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2
});

function showactivity(id){
    document.getElementById("bodyActivity").innerHTML = "";
    var divisa_primary = document.getElementById("select_divisa").value;
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=6&idu='+ idu+'&divi='+divisa_primary, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            if (id == 1){
                $.each(data,function(key, registro) {
                    var catego = '"'+registro.nombre+'"'
                    $("#bodyActivity").append("<div onclick='showactivitylvl("+id+","+catego+")' class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                            registro.nombre+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                            "<p class='text-success'>"+formatter.format(registro.ingreso)+"</p></h6>"+
                    "</div>");
                });
            } else if (id == 2){
                $.each(data,function(key, registro) {
                    var catego = '"'+registro.nombre+'"'
                    $("#bodyActivity").append("<div onclick='showactivitylvl("+id+","+catego+")' class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-10 col-lg-10 col-xl-10 text-muted mt-2'>"+
                            registro.nombre+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 col-lg-12 col-xl-12 text-muted'>"+
                            "<p class='text-danger'>"+formatter.format(registro.egreso)+"</p></h6>"+
                    "</div>");
                });
            }
        },
        error: function (data) {
        }
    });
    $("#ModalActivity").modal("show");
}
function showactivitylvl(id, nombre){
    $("#ModalActivity").modal("hide");
    document.getElementById("bodyActivityLvl").innerHTML = "";
    var divisa_primary = document.getElementById("select_divisa").value;
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=7&idu='+ idu+'&divi='+divisa_primary+
        '&account='+nombre+'&sig='+id, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            if (id == 1){
                $.each(data,function(key, registro) {
                    var catego = '"'+registro.nombre+'"';
                    var mes = '"'+registro.mes+'"';
                    $("#bodyActivityLvl").append("<div onclick='showactivityMonth("+id+","+catego+","+mes+")' class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                            registro.mes+"-"+registro.nombre+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                            "<p class='text-success'>"+formatter.format(registro.cantidad)+"</p></h6>"+
                    "</div>");
                });
            } else if (id == 2){
                $.each(data,function(key, registro) {
                    var catego = '"'+registro.nombre+'"';
                    var mes = '"'+registro.mes+'"';
                    $("#bodyActivityLvl").append("<div onclick='showactivityMonth("+id+","+catego+","+mes+")' class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-10 col-lg-10 col-xl-10 text-muted mt-2'>"+
                            registro.mes+"-"+registro.nombre+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 col-lg-12 col-xl-12 text-muted'>"+
                            "<p class='text-danger'>"+formatter.format(registro.cantidad)+"</p></h6>"+
                    "</div>");
                });
            }
        },
        error: function (data) {
        }
    });
    $("#ModalActivityLvl").modal("show");
    $("#btn_back_lvl").click(function(){
        $("#ModalActivityLvl").modal("hide");
        $("#ModalActivity").modal("show");
    });
}
function showactivityMonth(id, nombre, mes){
    $("#ModalActivityLvl").modal("hide");
    document.getElementById("bodyActivityMonth").innerHTML = "";
    var divisa_primary = document.getElementById("select_divisa").value;
    console.log('../json/reportes?action=8&idu='+ idu+'&divi='+divisa_primary+
        '&account='+nombre+'&mes='+mes+'&sig='+id);
    $.ajax({
        type: "GET",
        url: '../json/reportes?action=8&idu='+ idu+'&divi='+divisa_primary+
        '&account='+nombre+'&mes='+mes+'&sig='+id, 
        dataType: "json",
        success: function(data){
            //console.log(data);
            if (id == 1){
                $.each(data,function(key, registro) {
                    $("#bodyActivityMonth").append("<div class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                            registro.categoria+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                            "<p class='text-success'>"+formatter.format(registro.cantidad)+
                            "</p><p class='text-muted ml-1'></p>"+registro.fecha+"</h6>"+
                    "</div>");
                });
            } else if (id == 2){
                $.each(data,function(key, registro) {
                    $("#bodyActivityMonth").append("<div class='card border-botton border-right border-left'>"+
                            "<h4 class='card-title col-md-12 text-muted mt-2'>"+
                            registro.categoria+"</h3>"+
                            "<h6 class='card-title ml-3 row col-md-12 text-muted'>"+
                            "<p class='text-danger'>"+formatter.format(registro.cantidad)+
                            "</p><p class='text-muted ml-1'></p>"+registro.fecha+"</h6>"+
                    "</div>");
                });
            }
        },
        error: function (data) {
        }
    });
    $("#ModalActivityMonth").modal("show");
    $("#btn_back_moth").click(function(){
        $("#ModalActivityMonth").modal("hide");
        $("#ModalActivityLvl").modal("show");
    });
}
document.addEventListener("DOMContentLoadesd", function(){
    if(!Notification){
        alert("Las notificaciones no se soportan en tu navegador.");
        return;
    }
    if(Notification.permission != "granted")
        Notification.requestPermission();
});

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

