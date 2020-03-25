<?php
   class Password {
      const SALT = 'FiOnaApp';
      public static function hash($password) {
          return hash('sha512', self::SALT . $password);
      }
      public static function verify($password, $hash) {
          return ($hash == self::hash($password));
      }
   }
   $servername = "sguttman.czq11ubuofgu.us-east-2.rds.amazonaws.com";
   $username = "app_fiona";
   $password = "%Fiona2020%";
   $db = "fionadb";
   // Create connection
   $conn = mysqli_connect($servername, $username, $password,$db);
   // Check connection
   if (!$conn) {
      //die("Connection failed: " . mysqli_connect_error());
      echo 100;
   } 
   /*else {
      echo "Connected successfully";
   }*/
?>