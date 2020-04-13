<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $id = $_POST["id"];
    $valor = $_POST["valor"];
    $divisa = $_POST["divisa"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $cuenta_fin = $_POST["cuenta_fin"];
    $cuenta_ini = $_POST["cuenta_ini"];

    $delete="DELETE FROM fionadb.movimientos
    WHERE id=$id or id_transfe=$id;";
    $save_1 = mysqli_query($conn, $delete);

    $select ="SELECT * FROM fionadb.categorias WHERE id_user='$id_user' and grupo=5";
    $eject = mysqli_query($conn, $select);
    $result = mysqli_fetch_array($eject);
    $categoria = $result["id"];

    $insert_1 = "INSERT INTO fionadb.movimientos
    (cuenta, categoria, valor, divisa, trm, fecha, descripcion, id_transfe, id_user)
    VALUES('$cuenta_ini', '$categoria', $valor * -1, '$divisa', 1, '$fecha', '$descripcion', $cuenta_fin, '$id_user');    
    ";
    $insert_2 = "INSERT INTO fionadb.movimientos
    (cuenta, categoria, valor, divisa, trm, fecha, descripcion, id_transfe, id_user)
    SELECT '$cuenta_fin', '$categoria', $valor, '$divisa', 1 , '$fecha', '$descripcion', id, '$id_user'
    FROM fionadb.movimientos WHERE id_user = '$id_user' and fecha ='$fecha' and
    cuenta = '$cuenta_ini';  
    ";
    $save_2 = mysqli_query($conn, $insert_1);
    $save_3 = mysqli_query($conn, $insert_2);

    
    if(!$save_1 || !$save_2 || !$save_3){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>