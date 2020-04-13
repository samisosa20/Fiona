<?php
session_start();
$id_user = $_SESSION["Id_user"];
include_once("../conexions/connect.php");
$insert = "select
a.categoria, b.categoria AS sub_categoria, if(isnull(b.categoria), a.id, b.id) AS nro_sub_catego,
b.grupo, a.id_user from fionadb.categorias a left join fionadb.categorias b on
(a.id_user = b.id_user and b.sub_categoria = a.id) where
a.grupo <> 5 and a.sub_categoria = 0 and a.id_user = '$id_user' order by b.grupo desc, a.categoria";
$ejecutar =mysqli_query( $conn,$insert);
if (!$_GET["act"]){
    $select = 0;
} else{
    $select = $_GET["act"];
}
$aux = "";
$flag = 0;
echo "<option value='0' selected>Sin categoria</option>";
while ($lista = mysqli_fetch_array($ejecutar)){
    $id = $lista["nro_sub_catego"];
    $sub_categoria = $lista ["sub_categoria"];
    $categoria = $lista ["categoria"];
    if ($categoria != $aux){
        echo "<optgroup label='$categoria'>";
        $flag = 1;
    } else {
        $flag = 0;
    }
    if ($sub_categoria == NULL){
        $sub_categoria = $categoria;
    }
    if ($select == $id){
        echo "<option value='$id' selected>$sub_categoria</option>";
    } else {
        echo "<option value='$id'>$sub_categoria</option>";
    }
    if ($categoria != $aux && $aux != "" && $flag == 0){
        echo "</optgroup>";
    }
    $aux = $categoria;
}
mysqli_close($conn);
?>