<?php
    include_once("connect.php");

    $email = $_POST["email"];

    $select = "SELECT * FROM fionadb.users WHERE email=BINARY'$email'";
    $eject = mysqli_query($conn, $select);
    if(empty(mysqli_fetch_array($eject))){ 
        echo 500;
    } else {
        $new_pas=generateRandomString(8);
        $hash = Password::hash($new_pas);
        $consetiket="Contrsaseña: $new_pas";
        $contenido_mess="Esta es tu nueva contraseña, por favor una vez que ingrese
        a la plataforma cambie su contraseña.<br>";
        include("../Mailer/php/envioCorreo.php");
        $emailt = new email();

        $emailt->agregar($email,"");
                    
        if ($emailt->enviar('FIONA, Recuperación de contraseña',$contenido_html)){
            $change_pass="UPDATE fionadb.users SET password='$hash' WHERE email=BINARY'$email'";
            $save = mysqli_query($conn,$change_pass);
            echo 200;
        }else{
            $mensaje= 'El mensaje no se pudo enviar';
            $emailt->ErrorInfo;
            echo  $emailt->ErrorInfo;
        }
    }
    mysqli_close($conn);

    //Método con str_shuffle() 
    function generateRandomString($length) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    }
?>