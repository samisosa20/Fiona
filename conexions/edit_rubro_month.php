<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $mes = $_POST["mes"];
    $id = $_POST["id"];
    $valor = $_POST["valor"];
    $update = "UPDATE fionadb.presupuesto
    SET valor=$valor WHERE id=$id and id_user='$id_user';";
    $save = mysqli_query($conn, $update);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>