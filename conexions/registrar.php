<?php
    include_once("connect.php");
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $id_user=generateRandomString(5);
    $insert = "INSERT INTO fionadb.users
    (name, last_name, email, password, id_user)
    VALUES('$name', '$lastname', '$email', '$pass', '$id_user');      
    ";
    $save = mysqli_query($conn, $insert);
    if(!$save){ 
        echo 400;
    } else {
        echo 200;
    }
    mysqli_close($conn);
    //Método con str_shuffle() 
function generateRandomString($length) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 
?>