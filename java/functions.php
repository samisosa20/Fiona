<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
?>
if (document.getElementById("ModalCategora")) {
	var idu = <?php echo $id_user; ?>;
	PostCategoria("consult_cate.php");
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
						load_data(sub, idu);
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function PostCategoria(strURLop) {
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
				UpdatePage(xmlHttp.responseText);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdatePage(str){
		document.getElementById("categoria").innerHTML = str ;
	}
	function load_data(lvl, idu){
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

if (document.getElementById("ModalAccount")) {
	var idu = <?php echo $id_user; ?>;

	$("#save_account").click(function(){
		var nombre = document.getElementById("nombre").value;
		var descripcion = document.getElementById("descripcion").value;
		var divisa = document.getElementById("divisa").value;
		if (nombre == "" || divisa == 0) {
			if (nombre == ""){
				document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			}
			if (divisa == 0) {
				document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			}
		} else {
			$.ajax('../conexions/add_account.php', {
				type: 'POST',  // http method
				data: { nombre: nombre,
				descripcion: descripcion,
				divisa: divisa },  // data to submit
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalAccount').modal('hide');
						document.getElementById("nombre").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("nombre").value = "";
						document.getElementById("descripcion").value = "";
						document.getElementById("divisa").value = 0;
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
	function PostCategoria(strURLop) {
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
				UpdatePage(xmlHttp.responseText);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdatePage(str){
		document.getElementById("categoria").innerHTML = str ;
	}
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
							return "";
							}
						},
						{data: 'categoria'},
						{data: 'valor'},
						{data: 'divisa'},
						{data: 'fecha'},
						{data: 'id'},
						{data: 'dia'},
						{data: 'mes'},
						{data: 'ano'}
				]
				} );
			},
			error: function(data) {
				alert("Error");
			}
		});
  	};
	function PostCategoria(strURLop) {
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
				UpdatePage(xmlHttp.responseText);
			}
		}
		xmlHttp.send(strURLop);
	}
	function UpdatePage(str){
		document.getElementById("categoria").innerHTML = str ;
	}
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
		PostCategoria("consult_cate.php");
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
	function signo(){
		var nro = document.getElementById("valor").value;
		var signal = document.getElementById("monto_signal");
		if (nro < 0){
			signal.innerHTML = "-";
			signal.value = "-";
			signal.className = "btn btn-outline-danger";
			document.getElementById("valor").value = nro * -1;
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
};