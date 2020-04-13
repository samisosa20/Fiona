<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $nombre = $_POST["nombre"];
    $id = $_POST["id"];
    $descripcion = $_POST["descripcion"];
    $divisa = $_POST["divisa"];
    $monto_ini = $_POST["monto_ini"];
    $acco_save = $_POST["acco_save"];
    $update = "UPDATE fionadb.cuentas
    SET nombre='$nombre', descripcion='$descripcion', Divisa='$divisa', monto_inicial=$monto_ini,
    cuenta_ahorro=$acco_save
    WHERE id=$id and id_user='$id_user';";
    $save = mysqli_query($conn, $update);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>