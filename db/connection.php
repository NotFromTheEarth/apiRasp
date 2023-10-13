<?php
    function make_connection() {
        include("config.php");
        $mysqli = new mysqli($hostname, $username, $password, $database);
     
        if($mysqli->connect_error) 
        {
            BadRequest("Can't connect to DB.");
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }
        return $mysqli;
     }

     function close_connection($mysqli)
     {
        mysqli_close($mysqli);
     }
?>