<?php
    //to see stored data:
    //http://localhost/apirasp/see.php
    
    //to send data do be recorded:
    // API URL
    $url = 'http://localhost/apiRasp/';

    //now
    $dt = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
    $now = $dt->format("Y-m-d H:i:s");
    
    //payload is a json with the data
    $payload = '{"d@tA":[{"t":"2023-10-13 20:26:46","s1":"sensor1","s2":"sensor2"},{"t":"2023-10-13 20:26:47","s1":"sensor1","s2":"sensor2"},{"t":"2023-10-13 20:26:48","s1":"sensor1","s2":"sensor2"}]}';
    $payload = '{"d@tA":[
                            {"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},
                            {"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},
                            {"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},
                            {"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"},
                            {"t":"'. $now .'","s1":"'.rand(0, 1023).'","s2":"'.rand(0, 1023).'"}
                        ]}';

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

    $errorMessage = curl_error($ch);
    echo $errorMessage;

    // Show the HTTP code that was returned by the server
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo $httpCode;

    // Close cURL resource
    curl_close($ch);
?>