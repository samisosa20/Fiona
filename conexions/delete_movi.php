<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $id = $_POST["id"];
    $fecha = $_POST["fecha"];
    $delete = "DELETE FROM fionadb.movimientos
    WHERE (id=$id or id_transfe=$id) and fecha='$fecha' and id_user='$id_user';";
    $save = mysqli_query($conn, $delete);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>