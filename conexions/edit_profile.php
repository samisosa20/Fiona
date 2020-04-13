<?php
    session_start();
    $id_user = $_SESSION["Id_user"];
    include_once("connect.php");
    $name = $_POST["name"];
    $lastname = $_POST["last_name"];
    $pass = $_POST["passw"];
    $divisa = $_POST["divisa"];
    $hash = Password::hash($pass);

    if($_FILES["file"]["name"] != '')
    {
        $test = explode('.', $_FILES["file"]["name"]);
        $ext = end($test);
        $name_photo = $_SESSION["Id_user"].'.' . $ext;
        $location = '../img/' . $name_photo;
        if(file_exists($location)) {
            chmod($location,0755); //Change the file permissions if allowed
            unlink($location); //remove the file
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);
        if ($pass != ""){
            $update = "UPDATE fionadb.users
            SET name='$name', last_name='$lastname', password='$hash',
            divisa_prim='$divisa', photo='$location'
            WHERE id_user='$id_user';";
        } else{
            $update = "UPDATE fionadb.users
            SET name='$name', last_name='$lastname', divisa_prim='$divisa'
            , photo='$location'
            WHERE id_user='$id_user';";

        }
    } else {
        if ($pass != ""){
            $update = "UPDATE fionadb.users
            SET name='$name', last_name='$lastname', password='$hash',
            divisa_prim='$divisa'
            WHERE id_user='$id_user';";
        } else{
            $update = "UPDATE fionadb.users
            SET name='$name', last_name='$lastname', divisa_prim='$divisa'
            WHERE id_user='$id_user';";
        }
    }
    
    $save = mysqli_query($conn, $update);
    if(!$save){ 
        echo $update;
    } else {
        echo 200;
        $_SESSION["name"] = $name;
        $_SESSION["last_name"] = $lastname;
        if($_FILES["file"]["name"] != '')
        {
            $_SESSION["photo"] = $location;
        }
    }
    mysqli_close($conn);
?>