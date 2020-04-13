<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $id = $_POST["id"];
    $delete1 = "DELETE FROM fionadb.cuentas
    WHERE id=$id and id_user='$id_user';";
    $delete2 = "DELETE FROM fionadb.movimientos
    WHERE cuenta=$id and id_user='$id_user';";
    $save1 = mysqli_query($conn, $delete1);
    $save2 = mysqli_query($conn, $delete2);
    if(!$save1 || !$save2){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>