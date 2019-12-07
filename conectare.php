<?php
    $conectare = mysqli_connect("localhost", "root","", "appiris");
    if(!$conectare)
     {
        echo "EROARE!".'</br>';
        die(mysqli_connect_error());
      }
?>