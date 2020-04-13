<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $nombre = $_POST["nombre"];
    $id = $_POST["id"];
    $descripcion = $_POST["descripcion"];
    $grupo = $_POST["grupo"];
    $sub_categoria = $_POST["sub_categoria"];
    $update = "UPDATE fionadb.categorias
    SET categoria='$nombre', sub_categoria='$sub_categoria', grupo='$grupo',
    descripcion='$descripcion' WHERE id=$id and id_user='$id_user';";
    $save = mysqli_query($conn, $update);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>