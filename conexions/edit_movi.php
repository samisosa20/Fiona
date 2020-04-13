<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $id =  $_POST["id"];
    $valor =  $_POST["valor"];
    $divisa =  $_POST["divisa"];
    $descripcion =  $_POST["descripcion"];
    $fecha =  $_POST["fecha"];
    $categoria =  $_POST["categoria"];
    $cuenta =  $_POST["cuenta"];
    $update = "UPDATE fionadb.movimientos
    SET cuenta='$cuenta', categoria='$categoria', valor=$valor, divisa='$divisa',
    trm=1, fecha='$fecha', descripcion='$descripcion'
    WHERE id=$id and id_user='$id_user';";
    $save = mysqli_query($conn, $update);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>