<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        include_once("./db/action.php");
        showRecords();
    }
    else
    {
        echo "Error on request method";
    }
?>