<?php
   class Password {
      const SALT = 'FiOnA2020';
      public static function hash($password) {
          return hash('sha512', self::SALT . $password);
      }
      public static function verify($password, $hash) {
          return ($hash == self::hash($password));
      }
   }
   $servername = "localhost";
   $username = "root";
   $password = "root";
   $db = "fiona";
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
