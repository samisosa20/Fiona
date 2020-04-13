<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $cuenta = $_POST["cuenta"];
    $valor = $_POST["valor"];
    $divisa = $_POST["divisa"];
    $categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $insert = "INSERT INTO fionadb.movimientos
    (cuenta, categoria, valor, divisa, trm, fecha, descripcion, id_user)
    VALUES('$cuenta', '$categoria', $valor, '$divisa', 1, '$fecha', '$descripcion', '$id_user');    
    ";
    $save = mysqli_query($conn, $insert);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>