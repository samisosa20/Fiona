<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
?>
if (document.getElementById("ModalCategora")) {
	var idu = <?php echo $id_user; ?>;
	PostCategoria("consult_cate.php", "categoria");
	$("#save_cate").click(function(){
		var nombre = document.getElementById("nombre").value;
		var descripcion = document.getElementById("descripcion").value;
		var grupo = document.getElementById("grupo").value;
		var categoria = document.getElementById("categoria").value;
		if (nombre == "" || grupo == 0) {
			if (nombre == ""){
				document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
			if (grupo == 0) {
				document.getElementById("grupo").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_categoria.php', {
				type: 'POST',  // http method
				data: { nombre: nombre,
				descripcion: descripcion,
				grupo: grupo,
				categoria: categoria },  // data to submit
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalCategora').modal('hide');
						document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("grupo").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("nombre").value = "";
						document.getElementById("descripcion").value = "";
						document.getElementById("grupo").value = 0;
						document.getElementById("categoria").value = 0;
						var url = window.location.href;
						var div = url.split("#");
						var sub = div[1];
						if (!sub){
							sub = 0;
						}
						load_data_cat(sub, idu);
						PostCategoria("consult_cate.php", "categoria");
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function load_data_cat(lvl, idu){
		document.getElementById("card_catego").innerHTML = "";
		if (lvl != 0) {
				$("#card_catego").append("<div class='col-md-6'>"+
					"<a class='card' href='#0'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-9 col-lg-9 col-xl-9 text-muted'>..</h3>"+
								"<h4 class='card-title col-md-3 col-lg-3 col-xl-3 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>");
				}
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=1&idu='+idu+'&lvl='+lvl, 
			dataType: "json",
			success: function(data){
				$.each(data,function(key, registro) {
					$("#card_catego").append("<div class='col-md-6'>"+
						"<a class='card' href='#"+registro.id+"'>"+
							"<div class='card-body'>"+
								"<div class='row'>"+
									"<h3 class='card-title col-md-9 col-lg-9 col-xl-9'>"+registro.categoria+"</h3>"+
									"<h4 class='card-title col-md-3 col-lg-3 col-xl-3'>"+registro.cantidad+
										"<i class='icon-arrow-right'></i></h4>"+
								"</div>"+
							"</div>"+
						"</a>"+
					"</div>");
				});
				$("#card_catego").append("<div class='col-md-6'>"+
					"<a class='card' id='add_categoria' data-target='#ModalCategora' data-toggle='modal'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-9 col-lg-9 col-xl-9 text-muted'><i class='fas fa-plus mr-2'></i>Nueva categoria</h3>"+
								"<h4 class='card-title col-md-3 col-lg-3 col-xl-3 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>");    
			},
			error: function(data) {
				$("#card_catego").append("<div class='col-md-6'>"+
					"<a class='card' id='add_categoria' data-target='#ModalCategora' data-toggle='modal'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-9 col-lg-9 col-xl-9 text-muted'><i class='fas fa-plus mr-2'></i>Nueva categoria</h3>"+
								"<h4 class='card-title col-md-3 col-lg-3 col-xl-3 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>"); 
			}
		});
	};
	var aux = 0;
	load_data_cat(0, idu);
	setInterval(function(){
		var url = window.location.href;
		var div = url.split("#");
		var sub = div[1];
		if (!sub){
			sub = 0;
		}
		if (sub != aux){
			var idu = <?php echo $id_user; ?>;
			aux = sub;
			load_data_cat(sub, idu);
		}
	}, 1000);
};

if (document.getElementById("ModalAccount")) {
	var idu = <?php echo $id_user; ?>;

	$("#save_account").click(function(){
		var nombre = document.getElementById("nombre").value;
		var descripcion = document.getElementById("descripcion").value;
		var divisa = document.getElementById("divisa").value;
		var monto_ini = document.getElementById("monto_ini").value;
		if (nombre == "" || divisa == 0 || monto_ini == "") {
			if (nombre == ""){
				document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
			if (divisa == 0) {
				document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
			if (monto_ini == ""){
				document.getElementById("monto_ini").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_account.php', {
				type: 'POST',  // http method
				data: { nombre: nombre,
				descripcion: descripcion,
				divisa: divisa,
				monto_ini: monto_ini },  // data to submit
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalAccount').modal('hide');
						document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("monto_ini").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("nombre").value = "";
						document.getElementById("descripcion").value = "";
						document.getElementById("divisa").value = 0;
						document.getElementById("monto_ini").value = 0;
						var url = window.location.href;
						var div = url.split("#");
						var sub = div[1];
						if (!sub){
							sub = 0;
						}
						load_data(sub, idu);
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function load_data(lvl, idu){
		document.getElementById("card_account").innerHTML = "";
		if (lvl != 0) {
				$("#card_catego").append("<div class='col-md-6'>"+
					"<a class='card' href='#0'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'>..</h3>"+
								"<h4 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>");
				}
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=2&idu='+idu+'&lvl='+lvl, 
			dataType: "json",
			success: function(data){
				$.each(data,function(key, registro) {
					$("#card_account").append("<div class='col-md-6'>"+
						"<div class='card'>"+
							"<div class='card-body'>"+
								"<div class='row'>"+
									"<h3 class='card-title col-md-6 col-lg-6 col-xl-6'>"+registro.nombre+"</h3>"+
									"<h4 class='card-title col-md-6 col-lg-6 col-xl-6'>$ "+registro.cantidad+"</h4>"+
								"</div>"+
								"<p class='card-text'>Divisas: "+registro.divisa+"</p>"+
								"<a href='movimientos.php?account="+registro.id+"' class='btn btn-success'>Entrar</a>"+
							"</div>"+
						"</div>"+
					"</div>");
				});
				$("#card_account").append("<div class='col-md-6'>"+
					"<a class='card' id='add_categoria' data-target='#ModalAccount' data-toggle='modal'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'><i class='fas fa-plus mr-2'></i>Nueva cuenta</h3>"+
								"<h4 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>");    
			},
			error: function(data) {
				$("#card_account").append("<div class='col-md-6'>"+
					"<a class='card' id='add_categoria' data-target='#ModalAccount' data-toggle='modal'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'><i class='fas fa-plus mr-2'></i>Nueva cuenta</h3>"+
								"<h4 class='card-title col-md-6 col-lg-6 col-xl-6 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>"); 
			}
		});
	};
	var aux = 0;
	load_data(0, idu);
	setInterval(function(){
		var url = window.location.href;
		var div = url.split("#");
		var sub = div[1];
		if (!sub){
			sub = 0;
		}
		if (sub != aux){
			var idu = <?php echo $id_user; ?>;
			aux = sub;
			load_data(sub, idu);
		}
	}, 1000);
};

if (document.getElementById("table_move_acc")){
	var idu = <?php echo $id_user; ?>;
	var url = window.location.href;
	var div = url.split("=");
	var sub = div[1];
	rellenar_table_move_acc();
	PostTitleMovi("consult_title_movi.php?action=1&id="+sub);
	PostDescAcc("consult_title_movi.php?action=2&id="+sub);
	function rellenar_table_move_acc(){
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=3&idu='+idu+'&lvl='+sub, 
			dataType: "json",
			success: function(data){
				$('#table_move_acc').DataTable( {
			  		"columnDefs": [
						{"className": "text-center", "targets": "_all"}
			  		],
					data: data,
					columns: [
						{ sortable: false,
							"render": function ( data, type, full, meta ) {
							var id= full.id;
							var categoria = '"' + full.categoria + '"';
							var valor = '"' + full.valor + '"';
							var fecha = '"' + full.fecha + '"';
							var descripcion = '"' + full.descripcion + '"';
							var divisa = '"' + full.divisa + '"';
							var nro_cate = full.nro_cate;
							var valor_int = full.valor_int;
							var id_transfer = full.id_transfe;
							if (full.categoria != "Transferencia"){
								return "<i class='fas fa-edit mr-3' style='color: #20c997;' onclick='edit_trans("+id+","+nro_cate+","+valor_int+","+fecha+","+descripcion+","+divisa+","+sub+")'></i>"+
								"<i class='fas fa-trash-alt' style='color: red;' onclick='delete_trans("+id+","+categoria+","+valor+","+fecha+")'></i>";
							} else {
								return "<i class='fas fa-edit mr-3' style='color: #20c997;' onclick='edit_movi("+id+","+id_transfer+","+valor_int+","+fecha+","+descripcion+","+divisa+","+sub+")'></i>"+ 
								"<i class='fas fa-trash-alt' style='color: red;' onclick='delete_trans("+id+","+categoria+","+valor+","+fecha+")'></i>";
							}
							}
						},
						{data: 'categoria'},
						{ sortable: false,
							"render": function ( data, type, full, meta ) {
							var valor= full.valor;
							if (valor.indexOf('-') != -1){
								return "<p class='text-danger'>"+valor+"</p>";
							} else {
								return "<p class='text-success'>"+valor+"</p>";
							}
							}
						},
						{data: 'divisa'},
						{data: 'fecha'},
						{ sortable: false,
							"render": function ( data, type, full, meta ) {
							var valor= full.valor;
							return "";
							}
						},
						{data: 'dia'},
						{data: 'mes'},
						{data: 'ano'}
					]
				} );
			},
			error: function(data) {
				$('#table_move_acc').DataTable( {});
			}
		});
  	};
	function PostTitleMovi(strURLop) {
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
				UpdateTitle(xmlHttp.responseText);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdateTitle(str){
		document.getElementById("title_movi").innerHTML = str ;
	}
	function PostDescAcc(strURLop) {
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
				UpdateDescripAcc(xmlHttp.responseText);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdateDescripAcc(str){
		document.getElementById("descri_acc").innerHTML = str ;
	}
	$("#add_move_btn").click(function(){
		PostCategoria("consult_cate.php", "categoria");
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

		document.getElementById("fecha").value = formattedDateTime;
	});
	$("#monto_signal").click(function(){
		var signal = document.getElementById("monto_signal");
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
	$("#trans_monto_signal").click(function(){
		var signal = document.getElementById("monto_signal");
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
	function signo(id, id2){
		var nro = document.getElementById(id).value;
		var signal = document.getElementById(id2);
		if (nro < 0){
			signal.innerHTML = "-";
			signal.value = "-";
			signal.className = "btn btn-outline-danger";
			document.getElementById(id).value = nro * -1;
		} else {
			signal.innerHTML = "+";
			signal.value = "+";
			signal.className = "btn btn-outline-success";
		}
	};
	$("#save_trans").click(function(){
		var monto_signal = document.getElementById("monto_signal").value;
		var valor = document.getElementById("valor").value;
		var divisa = document.getElementById("divisa").value;
		var categoria = document.getElementById("categoria").value;
		var descripcion = document.getElementById("descripcion").value;
		var fecha = document.getElementById("fecha").value;
		if (monto_signal == '-'){
			valor = valor * -1;
		}
		if (valor == "" || valor == 0 || divisa == "" || categoria == "" || fecha == "") {
			if (valor == "" || valor == 0){
				document.getElementById("valor").className = "form-control is-invalid";
			}
			if (divisa == "") {
				document.getElementById("divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0 is-invalid";
			}
			if (categoria == "") {
				document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
			if (fecha == "") {
				document.getElementById("fecha").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_transaccion.php', {
				type: 'POST',
				data: {
					cuenta: sub,
					valor: valor,
					divisa: divisa,
					categoria: categoria,
					descripcion: descripcion,
					fecha: fecha
				},
				success: function (data, status, xhr) {
					console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalAdd').modal('hide');
						document.getElementById("valor").className = "form-control";
						document.getElementById("divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0";
						document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("fecha").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("valor").value = "";
						document.getElementById("monto_signal").value = "+";
						document.getElementById("monto_signal").innerHTML = "+";
						document.getElementById("divisa").value = "COP";
						document.getElementById("descripcion").value = "";
						document.getElementById("categoria").value = 0;
						$('#table_move_acc').dataTable().fnDestroy();
						rellenar_table_move_acc();
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function delete_trans(id, categoria, valor, fecha){
		$('#ModalDelete').modal('show');
		document.getElementById("text_delete").innerHTML = "Esta segur@ de eliminar la transacción <strong>"+
		categoria + " </strong> por un valor de  <strong>" + valor + " </strong> con fecha " + fecha;
		$('#delete_trans').click(function(){
			$.ajax({
				url: '../conexions/delete_movi.php', 
				type: 'POST',
				data: {id: id },
				success: function(data){
					alert("Se guardaron los cambios.");
					$('#ModalDelete').modal('hide');
					$('#table_move_acc').dataTable().fnDestroy();
					rellenar_table_move_acc();
				},
				error: function(data) {
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_trans(id, categoria, valor, fecha, descripcion, divisa, acco){
		PostCategoria("consult_cate.php?act="+categoria, "edit_categoria");
		PostCuentas("consult_accont.php?act="+acco, "edit_cuenta");
		document.getElementById("edit_valor").value = valor;
		document.getElementById("edit_divisa").value = divisa;
		document.getElementById("edit_descripcion").value = descripcion;
		var div = fecha.split(" ");
		var fecha2 = div[0] + 'T' + div[1];
		document.getElementById("edit_fecha").value = fecha2;
		$('#ModalEdit').modal('show');
		$('#edit_trans').unbind('click').click(function(){
			valor = document.getElementById("edit_valor").value;
			divisa = document.getElementById("edit_divisa").value;
			descripcion = document.getElementById("edit_descripcion").value;
			fecha = document.getElementById("edit_fecha").value;
			categoria = document.getElementById("edit_categoria").value;
			var cuenta = document.getElementById("edit_cuenta").value;
			var signo = document.getElementById("edit_monto_signal").value;
			if ( signo == '-') {
				valor = valor * -1;
			}
			$.ajax({
				url: '../conexions/edit_movi.php', 
				type: 'POST',
				data: {
					id: id,
					valor: valor,
					divisa: divisa,
					descripcion: descripcion,
					fecha: fecha,
					categoria: categoria,
					cuenta: cuenta
				},
				success: function(data){
					alert("Se guardaron los cambios.");
					$('#ModalEdit').modal('hide');
					$('#table_move_acc').dataTable().fnDestroy();
					rellenar_table_move_acc();
				},
				error: function(data) {
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_movi(id, id_transfer, valor, fecha, descripcion, divisa, acco){
		if (valor < 0){
			PostCuentas("consult_accont.php?act="+acco, "Edit_trans_cuenta_ini");
			PostCuentas("consult_accont.php?act="+id_transfer, "Edit_trans_cuenta_fin");
		} else {
			PostCuentas("consult_accont.php?act="+acco, "Edit_trans_cuenta_fin");
			PostCuentas("consult_accont.php?act="+id_transfer, "Edit_trans_cuenta_ini");
		}
		if (valor < 0){
			document.getElementById("Edit_trans_valor").value = valor * -1;
		} else {
			document.getElementById("Edit_trans_valor").value = valor;
		}
		
		document.getElementById("Edit_trans_divisa").value = divisa;
		document.getElementById("Edit_trans_descripcion").value = descripcion;
		var div = fecha.split(" ");
		var fecha2 = div[0] + 'T' + div[1];
		document.getElementById("Edit_trans_fecha").value = fecha2;
		$('#ModalTransEdit').modal('show');
		$('#Edit_trans_trans').unbind('click').click(function(){
			valor = document.getElementById("Edit_trans_valor").value;
			divisa = document.getElementById("Edit_trans_divisa").value;
			descripcion = document.getElementById("Edit_trans_descripcion").value;
			fecha = document.getElementById("Edit_trans_fecha").value;
			cuenta_ini = document.getElementById("Edit_trans_cuenta_ini").value;
			var cuenta_fin = document.getElementById("Edit_trans_cuenta_fin").value;
			$.ajax({
				url: '../conexions/edit_trans_acco.php', 
				type: 'POST',
				data: {
					id: id,
					valor: valor,
					divisa: divisa,
					descripcion: descripcion,
					fecha: fecha,
					cuenta_fin: cuenta_fin,
					cuenta_ini: cuenta_ini
				},
				success: function(data){
					if (data == 400) {
						alert ("Los datos no se guardaron correctamente.");
					}
					$('#ModalTransEdit').modal('hide');
					$('#table_move_acc').dataTable().fnDestroy();
					rellenar_table_move_acc();
				}
			});
		});
	};
	$('#add_trans_btn').click(function(){
		PostCuentas("consult_accont.php", "trans_cuenta_ini");
		PostCuentas("consult_accont.php", "trans_cuenta_fin");
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

		document.getElementById("trans_fecha").value = formattedDateTime;

	});
	$('#add_trans_btn').click(function(){
		var url = window.location.href;
		var div = url.split("=");
		var sub = div[1];
		PostCuentas("consult_accont.php", "trans_cuenta_fin");
		PostCuentas('consult_accont.php?act='+sub, "trans_cuenta_ini");
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

		document.getElementById("trans_fecha").value = formattedDateTime;
	});
    $("trans_monto_signal").click(function(){
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
    $("#trans_trans").click(function(){
		var monto_signal = document.getElementById("trans_monto_signal").value;
		var valor = document.getElementById("trans_valor").value;
        var cuenta_ini = document.getElementById("trans_cuenta_ini").value;
		var divisa = document.getElementById("trans_divisa").value;
		var cuenta_fin = document.getElementById("trans_cuenta_fin").value;
		var descripcion = document.getElementById("trans_descripcion").value;
		var fecha = document.getElementById("trans_fecha").value;
		if (monto_signal == '-'){
			valor = valor * -1;
		}
		if (valor == "" || valor == 0 || divisa == "" || cuenta_ini == 0 || cuenta_fin == 0 || fecha == "") {
			if (valor == "" || valor == 0){
				document.getElementById("trans_valor").className = "form-control is-invalid";
			}
			if (divisa == "") {
				document.getElementById("trans_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0 is-invalid";
			}
			if (cuenta_fin == 0) {
				document.getElementById("trans_cuenta_fin").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
            if (cuenta_ini == 0) {
				document.getElementById("trans_cuenta_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
			if (fecha == "") {
				document.getElementById("trans_fecha").className = "form-control custom-radius custom-shadow border-0 is-invalid";
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
					console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalTransDash').modal('hide');
						document.getElementById("trans_valor").className = "form-control";
						document.getElementById("trans_divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0";
						document.getElementById("trans_cuenta_fin").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
                        document.getElementById("trans_cuenta_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("trans_fecha").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("trans_valor").value = "";
						document.getElementById("trans_monto_signal").value = "+";
						document.getElementById("trans_monto_signal").innerHTML = "+";
						document.getElementById("trans_divisa").value = "COP";
						document.getElementById("trans_descripcion").value = "";
                        document.getElementById("trans_cuenta_ini").value = 0;
						document.getElementById("trans_cuenta_fin").value = 0;
						$('#table_move_acc').dataTable().fnDestroy();
						rellenar_table_move_acc();
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
};

if (document.getElementById("body_profile")){
	var idu = <?php echo $id_user; ?>;
	PostProfile("consult_profile.php?action=1", 1);
	PostProfile("consult_profile.php?action=2", 2);
	PostProfile("consult_profile.php?action=3", 3);
	function PostProfile(strURLop, action) {
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
				UpdatePage(xmlHttp.responseText, action);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdatePage(str, action){
		if (action == 1){
			document.getElementById("name_profile").value = str ;
		}else if (action == 2){
			document.getElementById("last_name_profile").value = str ;
		}else if (action == 3){
			document.getElementById("email_profile").value = str ;
		}
	}
	$("#save_profile").click(function(){
		var name = document.getElementById("name_profile").value;
		var last_name = document.getElementById("last_name_profile").value;
		var passw1 = document.getElementById("pass_1").value;
		var passw2 = document.getElementById("pass_2").value;
		if (name == "" || passw1 != passw2 || (passw1.length < 6 && passw1.length >0)) {
			if (name == ""){
				document.getElementById("name_profile").className = "form-control is-invalid";
			}
			if (passw1 != passw2){
				document.getElementById("pass_2").className = "form-control is-invalid";
			}
			if (passw1.length < 6 && passw1.length >0){
				document.getElementById("pass_1").className = "form-control is-invalid";
			}
		} else {
			$.ajax('../conexions/edit_profile.php', {
				type: 'POST',
				data: {
					name: name,
					last_name: last_name,
					passw: passw2
				},
				success: function (data, status, xhr) {
					console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						document.getElementById("pass_1").value = "";
						document.getElementById("pass_2").value = "";
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});

	function val_pass_1() {
		var pass = document.getElementById("pass_1").value;
		if (pass.length < 6) {
			document.getElementById("pass_1").className = "form-control is-invalid";
		} else {
			document.getElementById("pass_1").className = "form-control is-valid";
		}
	};

	function val_pass_2() {
		var pass2 = document.getElementById("pass_2").value;
		var pass1 = document.getElementById("pass_1").value;
		if (pass1 != pass2) {
			document.getElementById("pass_2").className = "form-control is-invalid";
		} else {
			document.getElementById("pass_2").className = "form-control is-valid";
		}
	};
};

function PostCategoria(strURLop, div) {
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
			UpdatePageCate(xmlHttp.responseText, div);
		}
	}
	xmlHttp.send(strURLop);
}
function UpdatePageCate(str, div){
	document.getElementById(div).innerHTML = str ;
}

function PostCuentas(strURLop, div) {
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
			UpdateCuentas(xmlHttp.responseText, div);
		}
	}
	xmlHttp.send(strURLop);
}
function UpdateCuentas(str, div){
	document.getElementById(div).innerHTML = str ;
}

var idu = <?php echo $id_user;?>;
$.ajax({
	type: "GET",
	url: '../json/consult.php?action=4&idu='+idu, 
	dataType: "json",
	success: function(data){
		document.getElementById("balance").innerHTML = "";
		$.each(data,function(key, registro) {
			var utilidad_bal = registro.utilidad_bal;
			$("#balance").append("<i class='fas fa-credit-card mr-2 ml-1'></i>"+
                    "My Balance <p class='float-right'>" + utilidad_bal + "</p>");
		});   
	},
	error: function(data) {
		$.each(data,function(key, registro) {
			$("#balance").append("<i class='fas fa-credit-card mr-2 ml-1'></i>"+
                    "My Balance <p class='float-right'>0.00</p>");
		});  
	}
});