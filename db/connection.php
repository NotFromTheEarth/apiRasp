<?php
    function make_connection() {
        include("../config/db.php");
        $mysqli = new mysqli($hostname, $username, $password, $database);
     
        if($mysqli->connect_error) 
        {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }
        return $mysqli;
     }

     function close_connection($mysqli)
     {
        mysqli_close($mysqli);
     }
?>