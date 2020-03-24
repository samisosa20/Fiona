<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $cuenta_ini = $_POST["cuenta_ini"];
    $valor = $_POST["valor"];
    $divisa = $_POST["divisa"];
    $cuenta_fin = $_POST["cuenta_fin"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];

    $select ="SELECT * FROM fionadb.categorias WHERE id_user='$id_user' and grupo=5";
    $eject = mysqli_query($conn, $select);
    $result = mysqli_fetch_array($eject);
    $categoria = $result["id"];

    $insert_1 = "INSERT INTO fionadb.movimientos
    (cuenta, categoria, valor, divisa, trm, fecha, descripcion, id_user)
    VALUES('$cuenta_ini', '$categoria', $valor * -1, '$divisa', 1, '$fecha', '$descripcion', '$id_user');    
    ";
    $insert_2 = "INSERT INTO fionadb.movimientos
    (cuenta, categoria, valor, divisa, trm, fecha, descripcion, id_user)
    VALUES('$cuenta_fin', '$categoria', $valor, '$divisa', 1, '$fecha', '$descripcion', '$id_user');    
    ";
    $save_1 = mysqli_query($conn, $insert_1);
    $save_2 = mysqli_query($conn, $insert_2);
    if(!$save_1 || !$save_2){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>