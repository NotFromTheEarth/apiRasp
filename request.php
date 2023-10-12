<?php
    // API URL
    $url = 'http://localhost/apiRasp/';

    //payload is a json with the data
    $now = date("d-m-Y h:i:s");
    
    //example
    $payload = '{"d@tA":[{"t":"time1","s1":"sensor1","s2":"sensor2"},{"t":"time2","s1":"sensor1","s2":"sensor2"},{"t":"time2","s1":"sensor1","s2":"sensor2"}]}';
    $payload = '{"d@tA":[{"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},{"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},{"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"}]}';

    // Create a new cURL resource
    $ch = curl_init($url);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

    // Show the HTTP code that was returned by the server
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo $httpCode;

    // Close cURL resource
    curl_close($ch);
?>