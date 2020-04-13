<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $grupo = $_POST["grupo"];
    $categoria = $_POST["categoria"];
    $insert = "INSERT INTO fionadb.categorias
    (categoria, sub_categoria, descripcion, grupo, id_user)
    VALUES('$nombre', '$categoria', '$descripcion', '$grupo', '$id_user');
    ";
    $save = mysqli_query($conn, $insert);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
?>