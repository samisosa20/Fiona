<?php
session_start();
$id_user = "\"".$_SESSION["Id_user"]."\"";
?>
var idu = <?php echo $id_user;?>;
val_session(idu);
if (document.getElementById("ModalCategora")) {
	var idu = <?php echo $id_user; ?>;
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
						getPagina("consult_cate.php", "categoria");
						$.ajax({
							type: "GET",
							url: '../json/consult.php?action=7&idu='+idu, 
							dataType: "json",
							success: function(data){
								//console.log(data);
								$.each(data,function(key, registro) {
									if (registro.categorias == 2){
										$("#ModalCongratuCatego").modal('show');
									}
								});   
							}
						}); 
						
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function delete_catego(id, nombre){
		document.getElementById("text_delete_catego").innerHTML=
		"Esta segur@ de eliminar la categoria: <strong>" + nombre + "</strong>, si lo hace, " +
		"toda la información sera borrada.";
		$('#ModalDeletCatego').modal('show');
		$('#btn_delete_categoria').click(function(){
			$.ajax({
				url: '../conexions/delete_categoria.php', 
				type: 'POST',
				data: {id: id },
				success: function(data){
					$('#ModalDeletCatego').modal('hide');
					var url = window.location.href;
					var div = url.split("#");
					var sub = div[1];
					if (!sub){
						sub = 0;
					}
					load_data_cat(sub, idu);
			},
				error: function(data) {
					$('#ModalDeletCatego').modal('hide');
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_categoria(id, nombre, descripcion, grupo, sub_categoria){
		getPagina("consult_cate.php?act="+sub_categoria, "edit_categoria");
		document.getElementById("edit_nombre").value = nombre;
		document.getElementById("edit_descripcion").value = descripcion;
		document.getElementById("edit_grupo").value = grupo;

		$('#ModalEditCatego').modal('show');
		$('#btn_edit_cate').unbind('click').click(function(){
			nombre = document.getElementById("edit_nombre").value;
			descripcion = document.getElementById("edit_descripcion").value;
			grupo = document.getElementById("edit_grupo").value;
			sub_categoria = document.getElementById("edit_categoria").value;
			if (nombre == "" || grupo == 0) {
				if (nombre == ""){
					document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
				}
				if (grupo == 0) {
					document.getElementById("edit_grupo").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
				}
			} else {
				$.ajax('../conexions/edit_catego.php', {
					type: 'POST',  // http method
					data: { nombre: nombre,
					id: id,
					descripcion: descripcion,
					grupo: grupo,
					sub_categoria: sub_categoria },  // data to submit
					success: function (data, status, xhr) {
						//console.log('status: ' + status + ', data: ' + data);
						if (data == 200) {
							$('#ModalEditCatego').modal('hide');
							document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0";
							document.getElementById("edit_grupo").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
							document.getElementById("edit_nombre").value = "";
							document.getElementById("edit_descripcion").value = "";
							document.getElementById("edit_grupo").value = 0;
							document.getElementById("edit_categoria").value = 0;
							var url = window.location.href;
							var div = url.split("#");
							var sub = div[1];
							if (!sub){
								sub = 0;
							}
							load_data_cat(sub, idu);
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
								}
							});
						} else {
							alert("Error: " + data);
						}
					}
				});
			}
		});
	};
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
					$("#card_catego").append("<div class='card col-md-6'>"+
						"<div class='card-body' style='padding-left: 10px; padding-right: 10px;'>"+
							"<i class='icon-arrow-right float-right mt-3 ml-2 fa-2x'></i>"+
							"<i class='fas fa-trash-alt float-right mt-4' onclick='delete_catego("+registro.id+","+'"'+registro.categoria+'"'+")' style='color: red;'></i>"+
							"<i class='far fa-edit float-right mr-1 mt-4' onclick='edit_categoria("+registro.id+","+'"'+registro.categoria+'"'+","+'"'+registro.descripcion+'"'+","+registro.grupo+","+registro.sub_categoria+")'"+
							" style='color: #5f76e8;'></i>"+
							"<a href='#"+registro.id+"'>"+
								"<div class='row'>"+
									"<h3 class='card-title col-md-9 col-lg-9 col-xl-9 mt-3'>"+registro.categoria+"</h3>"+
								"</div>"+
							"</a>"+
						"</div>"+
					"</div>");
				});
				$("#card_catego").append("<div class='col-md-6'>"+
					"<a class='card' id='add_categoria' data-target='#ModalCategora' data-toggle='modal'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<div class='col-md-9 col-lg-9 col-xl-9'><h3 class='card-title text-muted'><i class='fas fa-plus mr-2'></i>Nueva categoria</h3></div>"+
								"<div class='col-md-12 col-lg-12 col-xl-12' style='position: absolute;'><h4 class='card-title text-muted fa-2x float-right'><i class='icon-arrow-right'></i></h4></div>"+
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
	function val_new_cate(idu){
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=7&idu='+idu, 
			dataType: "json",
			success: function(data){
				//console.log(data);
				$.each(data,function(key, registro) {
					if (registro.categorias == 1){
						$("#ModalCategoAddInfo").modal('show');
					}
				});   
			}
		}); 
	}
	var aux = 0;
	load_data_cat(0, idu);
	getPagina("consult_cate.php", "categoria");
	load_data_balance();
	val_new_cate(idu)
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
			getPagina("consult_cate.php?act="+sub, "categoria");
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
		var acco_save = document.getElementById("account_save").checked;
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
				acco_save: acco_save,
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
						document.getElementById("account_save").checked = false;
						var url = window.location.href;
						var div = url.split("#");
						var sub = div[1];
						if (!sub){
							sub = 0;
						}
						load_data(sub, idu);
						load_data_balance();
						$.ajax({
							type: "GET",
							url: '../json/consult.php?action=7&idu='+idu, 
							dataType: "json",
							success: function(data){
								//console.log(data);
								$.each(data,function(key, registro) {
									if (registro.cuentas == 1){
										$("#ModalCongratuAccon").modal('show');
									}
								});   
							}
						}); 
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function delete_account(id, nombre){
		document.getElementById("text_delete_acco").innerHTML=
		"Esta segur@ de eliminar la cuenta: <strong>" + nombre + "</strong>, si lo hace, " +
		"toda la información sera borrada.";
		$('#ModalDeletAcco').modal('show');
		$('#btn_delete_account').click(function(){
			$.ajax({
				url: '../conexions/delete_account.php', 
				type: 'POST',
				data: {id: id },
				success: function(data){
					$('#ModalDeletAcco').modal('hide');
					var url = window.location.href;
					var div = url.split("#");
					var sub = div[1];
					if (!sub){
						sub = 0;
					}
					load_data(sub, idu);
					load_data_balance();
			},
				error: function(data) {
					$('#ModalDeletAcco').modal('hide');
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_account(id, nombre, descripcion, divisa, cantidad, ahorro){
		document.getElementById("edit_nombre").value = nombre;
		document.getElementById("edit_descripcion").value = descripcion;
		document.getElementById("edit_divisa").value = divisa;
		document.getElementById("edit_monto_ini").value = cantidad;
		if (ahorro == 1) {
			document.getElementById("edit_account_save").checked = true;
		}
		$('#ModalEditAcco').modal('show');
		$('#btn_edit_account').unbind('click').click(function(){
			nombre= document.getElementById("edit_nombre").value;
			descripcion= document.getElementById("edit_descripcion").value;
			divisa= document.getElementById("edit_divisa").value;
			cantidad= document.getElementById("edit_monto_ini").value;
			var acco_save = document.getElementById("edit_account_save").checked;
			if (nombre == "" || divisa == 0 || cantidad == "") {
				if (nombre == ""){
					document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
				}
				if (divisa == 0) {
					document.getElementById("edit_divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
				}
				if (cantidad == ""){
					document.getElementById("edit_monto_ini").className = "form-control custom-radius custom-shadow border-0 is-invalid";
				}
			} else {
				$.ajax('../conexions/edit_account.php', {
					type: 'POST',  // http method
					data: { nombre: nombre,
					id: id,
					descripcion: descripcion,
					divisa: divisa,
					acco_save: acco_save,
					monto_ini: cantidad },  // data to submit
					success: function (data, status, xhr) {
						//console.log('status: ' + status + ', data: ' + data);
						if (data == 200) {
							$('#ModalEditAcco').modal('hide');
							document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0";
							document.getElementById("edit_divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
							document.getElementById("edit_monto_ini").className = "form-control custom-radius custom-shadow border-0";
							document.getElementById("edit_nombre").value = "";
							document.getElementById("edit_descripcion").value = "";
							document.getElementById("edit_divisa").value = 0;
							document.getElementById("edit_monto_ini").value = 0;
							document.getElementById("edit_account_save").checked = false;
							var url = window.location.href;
							var div = url.split("#");
							var sub = div[1];
							if (!sub){
								sub = 0;
							}
							load_data(sub, idu);
							load_data_balance();
						} else {
							alert("Error: " + data);
						}
					}
				});
			}
		});
	};
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
					var mensaje = "";
					if (registro.cuenta_ahorro == 1){
						mensaje = "Cuenta ahorro";
					}
					$("#card_account").append("<div class='col-md-6'>"+
						"<div class='card'>"+
							"<div class='card-body'>"+
								"<div class='row'>"+
									"<h3 class='card-title col-md-6 col-lg-6 col-xl-6'>"+registro.nombre+"</h3>"+
									"<h4 class='card-title col-md-6 col-lg-6 col-xl-6'>$ "+registro.cantidad+"</h4>"+
								"</div>"+
								"<div class='row'>"+
									"<p class='card-text col-6'>Divisas: "+registro.divisa+"</p>"+
									"<p class='card-text col-6'>"+mensaje+"</p>"+
								"</div>"+
								"<a href='movimientos.php?account="+registro.id+"' class='btn btn-rounded btn-success mr-1'>"+
									"<i class='fas fa-sign-out-alt mr-2'></i>Entrar</a>"+
								"<button class='btn btn-circle btn-primary mr-1' onclick='edit_account("+registro.id+","+'"'+registro.nombre+'"'+
								","+'"'+registro.descripcion+'"'+","+'"'+registro.divisa+'"'+","+registro.monto_inicial+","+registro.cuenta_ahorro+")'>"+
									"<i class='far fa-edit'></i></button>"+
								"<button class='btn btn-circle btn-danger' onclick='delete_account("+registro.id+","+'"'+registro.nombre+'"'+")'>"+
									"<i class='fas fa-trash-alt'></i></button>"+
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
	function val_new_acco(idu){
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=7&idu='+idu, 
			dataType: "json",
			success: function(data){
				//console.log(data);
				$.each(data,function(key, registro) {
					if (registro.cuentas == 0){
						$("#ModalAccountInfo").modal('show');
					}
				});   
			}
		}); 
	}
	var aux = 0;
	load_data(0, idu);
	load_data_balance();
	val_new_acco(idu);
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

if (document.getElementById("card_presu")) {
	var idu = <?php echo $id_user; ?>;
	$("#save_account").click(function(){
		var nombre = document.getElementById("nombre").value;
		var descripcion = document.getElementById("descripcion").value;
		var divisa = document.getElementById("divisa").value;
		var monto_ini = document.getElementById("monto_ini").value;
		var acco_save = document.getElementById("account_save").checked;
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
				acco_save: acco_save,
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
						document.getElementById("account_save").checked = false;
						var url = window.location.href;
						var div = url.split("#");
						var sub = div[1];
						if (!sub){
							sub = 0;
						}
						load_data(sub, idu);
						load_data_balance();
						$.ajax({
							type: "GET",
							url: '../json/consult.php?action=7&idu='+idu, 
							dataType: "json",
							success: function(data){
								//console.log(data);
								$.each(data,function(key, registro) {
									if (registro.cuentas == 1){
										$("#ModalCongratuAccon").modal('show');
									}
								});   
							}
						}); 
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
	function delete_account(id, nombre){
		document.getElementById("text_delete_acco").innerHTML=
		"Esta segur@ de eliminar la cuenta: <strong>" + nombre + "</strong>, si lo hace, " +
		"toda la información sera borrada.";
		$('#ModalDeletAcco').modal('show');
		$('#btn_delete_account').click(function(){
			$.ajax({
				url: '../conexions/delete_account.php', 
				type: 'POST',
				data: {id: id },
				success: function(data){
					$('#ModalDeletAcco').modal('hide');
					var url = window.location.href;
					var div = url.split("#");
					var sub = div[1];
					if (!sub){
						sub = 0;
					}
					load_data(sub, idu);
					load_data_balance();
			},
				error: function(data) {
					$('#ModalDeletAcco').modal('hide');
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_account(id, nombre, descripcion, divisa, cantidad, ahorro){
		document.getElementById("edit_nombre").value = nombre;
		document.getElementById("edit_descripcion").value = descripcion;
		document.getElementById("edit_divisa").value = divisa;
		document.getElementById("edit_monto_ini").value = cantidad;
		if (ahorro == 1) {
			document.getElementById("edit_account_save").checked = true;
		}
		$('#ModalEditAcco').modal('show');
		$('#btn_edit_account').unbind('click').click(function(){
			nombre= document.getElementById("edit_nombre").value;
			descripcion= document.getElementById("edit_descripcion").value;
			divisa= document.getElementById("edit_divisa").value;
			cantidad= document.getElementById("edit_monto_ini").value;
			var acco_save = document.getElementById("edit_account_save").checked;
			if (nombre == "" || divisa == 0 || cantidad == "") {
				if (nombre == ""){
					document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0 is-invalid";
				}
				if (divisa == 0) {
					document.getElementById("edit_divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
				}
				if (cantidad == ""){
					document.getElementById("edit_monto_ini").className = "form-control custom-radius custom-shadow border-0 is-invalid";
				}
			} else {
				$.ajax('../conexions/edit_account.php', {
					type: 'POST',  // http method
					data: { nombre: nombre,
					id: id,
					descripcion: descripcion,
					divisa: divisa,
					acco_save: acco_save,
					monto_ini: cantidad },  // data to submit
					success: function (data, status, xhr) {
						//console.log('status: ' + status + ', data: ' + data);
						if (data == 200) {
							$('#ModalEditAcco').modal('hide');
							document.getElementById("edit_nombre").className = "form-control custom-radius custom-shadow border-0";
							document.getElementById("edit_divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
							document.getElementById("edit_monto_ini").className = "form-control custom-radius custom-shadow border-0";
							document.getElementById("edit_nombre").value = "";
							document.getElementById("edit_descripcion").value = "";
							document.getElementById("edit_divisa").value = 0;
							document.getElementById("edit_monto_ini").value = 0;
							document.getElementById("edit_account_save").checked = false;
							var url = window.location.href;
							var div = url.split("#");
							var sub = div[1];
							if (!sub){
								sub = 0;
							}
							load_data(sub, idu);
							load_data_balance();
						} else {
							alert("Error: " + data);
						}
					}
				});
			}
		});
	};
	function load_data(lvl, idu){
		document.getElementById("card_presu").innerHTML = "";
		$.ajax({
			type: "GET",
			url: '../json/presupuesto.php?action=1&idu='+idu, 
			dataType: "json",
			success: function(data){
				$.each(data,function(key, registro) {
					$("#card_presu").append("<div class='col-md-6'>"+
						"<div class='card'>"+
							"<div class='card-body'>"+
								"<div class='row'>"+
									"<h3 class='card-title col-md-6 col-lg-6 col-xl-6'>"+registro.nombre+"</h3>"+
									"<h4 class='card-title col-md-6 col-lg-6 col-xl-6'>$ "+registro.cantidad+"</h4>"+
								"</div>"+
								"<div class='row'>"+
									"<p class='card-text col-6'>Divisas: "+registro.divisa+"</p>"+
									"<p class='card-text col-6'></p>"+
								"</div>"+
								"<a href='movimientos.php?account="+registro.id+"' class='btn btn-rounded btn-success mr-1'>"+
									"<i class='fas fa-sign-out-alt mr-2'></i>Entrar</a>"+
								"<button class='btn btn-circle btn-primary mr-1' onclick='edit_account("+registro.id+","+'"'+registro.nombre+'"'+
								","+'"'+registro.descripcion+'"'+","+'"'+registro.divisa+'"'+","+registro.monto_inicial+","+registro.cuenta_ahorro+")'>"+
									"<i class='far fa-edit'></i></button>"+
								"<button class='btn btn-circle btn-danger' onclick='delete_account("+registro.id+","+'"'+registro.nombre+'"'+")'>"+
									"<i class='fas fa-trash-alt'></i></button>"+
							"</div>"+
						"</div>"+
					"</div>");
				});
				$("#card_presu").append("<div class='col-md-6'>"+
					"<a class='card' href='new-presu.php'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-10 col-lg-10 col-xl-10 text-muted'><i class='fas fa-plus mr-2'></i>Nuevo presupuesto</h3>"+
								"<h4 class='card-title col-md-2 col-lg-2 col-xl-2 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>");    
			},
			error: function(data) {
				$("#card_presu").append("<div class='col-md-6'>"+
					"<a class='card' href='new-presu.php'>"+
						"<div class='card-body'>"+
							"<div class='row'>"+
								"<h3 class='card-title col-md-10 col-lg-10 col-xl-10 text-muted'><i class='fas fa-plus mr-2'></i>Nuevo presupuesto</h3>"+
								"<h4 class='card-title col-md-2 col-lg-2 col-xl-2 text-muted'><i class='icon-arrow-right'></i></h4>"+
							"</div>"+
						"</div>"+
					"</a>"+
				"</div>"); 
			}
		});
	};
	function val_new_acco(idu){
		$.ajax({
			type: "GET",
			url: '../json/consult.php?action=7&idu='+idu, 
			dataType: "json",
			success: function(data){
				//console.log(data);
				$.each(data,function(key, registro) {
					if (registro.cuentas == 0){
						$("#ModalAccountInfo").modal('show');
					}
				});   
			}
		}); 
	}
	var aux = 0;
	load_data(0, idu);
	load_data_balance();
	val_new_acco(idu);
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

if (document.getElementById("form_presu")){
	load_data_balance();
	$("#next_step_1").click(function(){
		var divisa = document.getElementById("divisa").value;
		var ano = document.getElementById("ano").value;
		if (divisa == 0 || ano == 0){
			if (divisa == 0){
				document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
			if (ano == 0){
				document.getElementById("ano").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("ano").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
		} else {
			document.getElementById("divisa").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			document.getElementById("ano").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			getPagina("consult_cate_presu.php", "categoria");
			document.getElementById("modo_presu").value = 0;
			$("#ModalSelectCat").modal("show");
		}
	});
	$("#back_step_1").click(function(){
		change_modal(1);
	});

	$("#back_step_2").click(function(){
		change_modal(2);
	});

	function change_modal(id){
		if (id == 1){
			$("#ModalInsertVal").modal("hide");
			$("#ModalSelectCat").modal("show");
		} else {
			$("#ModalInsertValMensu").modal("hide");
			$("#ModalSelectCat").modal("show");
		}
	};

	function name_btn(value){
		if (value){
			document.getElementById("btn_save_presu_type2").innerHTML = "Finalizar";
		} else {
			document.getElementById("btn_save_presu_type2").innerHTML = "Siguiente";
		}
	};
	$("#next_step_2").click(function(){
		var categoria = document.getElementById("categoria").value;
		var modo_presu = document.getElementById("modo_presu").value;
		if (categoria == 0 || modo_presu == 0){
			if (categoria == 0){
				document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
			if (modo_presu == 0){
				document.getElementById("modo_presu").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("modo_presu").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
		} else {
			$("#ModalSelectCat").modal("hide");
			if (modo_presu != 1){
				document.getElementById("valor").value = 0;
				$("#ModalInsertVal").modal("show");
			} else {
				document.getElementById("valor_mensual").value = 0;
				document.getElementById("mes_mensual").value = 1;
				document.getElementById("div_replicar").style.display = "block";
				$("#ModalInsertValMensu").modal("show");
			}
		}
	});

	$("#btn_save_presu_type1").click(function(){
		var mes_ini = document.getElementById("mes_ini").value;
		var valor = document.getElementById("valor").value;
		if (mes_ini == 0 || valor == 0){
			if (mes_ini == 0){
				document.getElementById("mes_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("mes_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
			if (valor == 0){
				document.getElementById("valor").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("valor").className = "form-control custom-radius custom-shadow border-0 is-valid";
			}
		} else {
			var categoria = document.getElementById("categoria").value;
			var modo_presu = document.getElementById("modo_presu").value;
			var divisa = document.getElementById("divisa").value;
			var ano = document.getElementById("ano").value;
			document.getElementById("back_step_1").style.display = "none";
			document.getElementById("btn_save_presu_type1").innerHTML ="<span class='spinner-border spinner-border-sm'"+
			 " role='status' aria-hidden='true'></span> Loading...";
			$.ajax('../conexions/add_presupuesto.php?act=1', {
				type: 'POST',  // http method
				data: { mes_ini: mes_ini,
					valor: valor,
					categoria: categoria,
					modo_presu: modo_presu,
					divisa: divisa,
					ano: ano },  // data to submit
				success: function (data, status, xhr) {
					//console.log('status: ' + status + ', data: ' + data);
					if (data == 200) {
						$('#ModalInsertVal').modal('hide');
						document.getElementById("back_step_1").style.display = "block";
						document.getElementById("btn_save_presu_type1").innerHTML ="Finalizar";
						document.getElementById("mes_ini").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("valor").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("mes_ini").value = 0;
						document.getElementById("categoria").value = 0;
						document.getElementById("modo_presu").value = 0;
						document.getElementById("valor").value = 0;
						$("#ModalSelectCat").modal("show");
						alert("Los datos se guardaron correctamente");
						document.getElementById("finaly_step").style.display = "block";
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});

	$("#btn_save_presu_type2").click(function(){
		var mes_ini = document.getElementById("mes_mensual").value;
		var valor = document.getElementById("valor_mensual").value;
		if ( mes_ini == 1){
			if (document.getElementById("replicar_val").checked){
				var replicar_val = 1;
			} else {
				var replicar_val = 0;
			}
		}
		if (mes_ini == 0 || valor == 0){
			if (mes_ini == 0){
				document.getElementById("mes_mensual").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("mes_mensual").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0 is-valid";
			}
			if (valor == 0){
				document.getElementById("valor_mensual").className = "form-control custom-radius custom-shadow border-0 is-invalid";
			} else {
				document.getElementById("valor_mensual").className = "form-control custom-radius custom-shadow border-0 is-valid";
			}
		} else {
			document.getElementById("back_step_2").style.display = "none";
			document.getElementById("btn_save_presu_type2").innerHTML ="<span class='spinner-border spinner-border-sm'"+
			 " role='status' aria-hidden='true'></span> Loading...";
			var categoria = document.getElementById("categoria").value;
			var modo_presu = document.getElementById("modo_presu").value;
			var divisa = document.getElementById("divisa").value;
			var ano = document.getElementById("ano").value;
			$.ajax('../conexions/add_presupuesto.php?act=2', {
				type: 'POST',  // http method
				data: { mes_ini: mes_ini,
					valor: valor,
					categoria: categoria,
					replicar_val: replicar_val,
					modo_presu: modo_presu,
					divisa: divisa,
					ano: ano },  // data to submit
					success: function (data, status, xhr) {
					if (data == 200) {
						$('#ModalInsertVal').modal('hide');
						var mes_ini = document.getElementById("mes_mensual").value;
						document.getElementById("mes_mensual").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
						document.getElementById("valor_mensual").className = "form-control custom-radius custom-shadow border-0";
						document.getElementById("valor_mensual").value = 0;
						if (document.getElementById("replicar_val").checked || mes_ini == 12){
							document.getElementById("replicar_val").checked = false;
							document.getElementById("mes_mensual").value = 0;
							document.getElementById("categoria").className = "custom-select mr-sm-2 custom-radius custom-shadow border-0";
							document.getElementById("categoria").value = 0;
							document.getElementById("modo_presu").value = 0;
							$("#ModalInsertValMensu").modal("hide");
							$("#ModalSelectCat").modal("show");
							document.getElementById("btn_save_presu_type2").innerHTML = "Siguiente";
							alert("Los datos se guardaron correctamente");
							document.getElementById("finaly_step").style.display = "block";
						} else {
							document.getElementById("mes_mensual").value = ++mes_ini;
							document.getElementById("replicar_val").checked = false;
							document.getElementById("div_replicar").style.display = "none";
							document.getElementById("back_step_2").style.display = "none";
							document.getElementById("btn_save_presu_type2").innerHTML = "Siguiente";
							if (mes_ini == 12){
								document.getElementById("btn_save_presu_type2").innerHTML = "Finalizar";
							}
						}
					} else {
						alert("Error: " + data);
					}
				}
			});
		}
	});
};

if (document.getElementById("table_move_acc")){
	var idu = <?php echo $id_user; ?>;
	var url = window.location.href;
	var div = url.split("=");
	var sub = div[1];
	rellenar_table_move_acc();
	getPagina("consult_title_movi.php?action=1&id="+sub,"title_movi");
	getPagina("consult_title_movi.php?action=2&id="+sub,"descri_acc");
	getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
	load_data_balance();
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
	$("#add_move_btn").click(function(){
		getPagina("consult_cate.php", "categoria");
		getPagina("consult_divisa.php?id="+sub, "divisa");
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
	$("#edit_monto_signal").click(function(){
		var signal = document.getElementById("edit_monto_signal");
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
			if (id2 != ''){
				signal.innerHTML = "-";
				signal.value = "-";
				signal.className = "btn btn-outline-danger";
			}
			document.getElementById(id).value = nro * -1;
		}
	};
	$("#save_trans").unbind('click').click(function(){
		var monto_signal = document.getElementById("monto_signal").value;
		var valor = document.getElementById("valor").value;
		var divisa = document.getElementById("divisa").value;
		var categoria = document.getElementById("categoria").value;
		var descripcion = document.getElementById("descripcion").value;
		var fecha = document.getElementById("fecha").value;
		if (monto_signal == '-'){
			valor = valor * -1;
		}
		if (valor == "" || valor == 0 || divisa == "" || categoria == 0 || fecha == "") {
			if (valor == "" || valor == 0){
				document.getElementById("valor").className = "form-control is-invalid";
			}
			if (divisa == "") {
				document.getElementById("divisa").className = "custom-select form-control bg-white custom-radius custom-shadow border-0 is-invalid";
			}
			if (categoria == 0) {
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
						getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
						load_data_balance();
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
		$('#delete_trans').unbind('click').click(function(){
			$.ajax({
				url: '../conexions/delete_movi.php', 
				type: 'POST',
				data: {id: id,
				fecha: fecha },
				success: function(data){
					alert("Se guardaron los cambios.");
					$('#ModalDelete').modal('hide');
					$('#table_move_acc').dataTable().fnDestroy();
					rellenar_table_move_acc();
					getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
					load_data_balance();
				},
				error: function(data) {
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_trans(id, categoria, valor, fecha, descripcion, divisa, acco){
		getPagina("consult_cate.php?act="+categoria, "edit_categoria");
		getPagina("consult_accont.php?act="+acco, "edit_cuenta");
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
					getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
					load_data_balance();
				},
				error: function(data) {
					alert("No se guardaron los cambios.");
				}
			});
		});
	};
	function edit_movi(id, id_transfer, valor, fecha, descripcion, divisa, acco){
		if (valor < 0){
			getPagina("consult_accont.php?act="+acco, "Edit_trans_cuenta_ini");
			getPagina("consult_accont.php?act="+id_transfer, "Edit_trans_cuenta_fin");
		} else {
			getPagina("consult_accont.php?act="+acco, "Edit_trans_cuenta_fin");
			getPagina("consult_accont.php?act="+id_transfer, "Edit_trans_cuenta_ini");
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
					getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
					load_data_balance();
				}
			});
		});
	};
	$('#add_trans_btn').click(function(){
		getPagina("consult_accont.php", "trans_cuenta_ini");
		getPagina("consult_accont.php", "trans_cuenta_fin");
		getPagina("consult_divisa.php?id="+sub, "trans_divisa");
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
    $("#trans_trans").unbind('click').click(function(){
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
						getPagina("consult_title_movi.php?action=3&id="+sub,"balance_acc");
						load_data_balance();
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
						alert("Los datos se guardaron correctamente");
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
			UpdatePagina(xmlHttp.responseText, div);
		}
	}
	xmlHttp.send(strURLop);
};
function UpdatePagina(str, div){
	document.getElementById(div).innerHTML = str ;
};

function val_session(idu){
    if(idu == ""){
        window.location = "/";
    }
};
function load_data_balance(){
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
			});
			$("#balance").append("<div class='dropdown-divider'></div>"+
				"<a class='dropdown-item' href='/'><i "+
				" class='fas fa-power-off mr-2 ml-1'></i>"+
				"Logout</a>"
			);
		}
	});
};