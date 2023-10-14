<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        echo "Bora mostrar";
    }
    else
    {
        echo "Error on request method";
    }
?>