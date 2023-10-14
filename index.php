<?php
    const datalogFile = 'datalog.txt';
    const errorlogFile = 'errorlog.txt';
    const packageLimitSize = 5000;
    const dataTag = 'd@tA';
    const timeTag = 't';
    const sensor1Tag = 's1';
    const sensor2Tag = 's2';

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $dataSize = GetDataSize($data);

            $package = [];
            for($i = 0; $i < $dataSize; $i++)
            {
                $dateTime = CheckData($data, $i, timeTag);
                $sensor1 = CheckData($data, $i, sensor1Tag);
                $sensor2 = CheckData($data, $i, sensor2Tag);
                
                $timestamp = strtotime($dateTime);
                $dateTime = date("Y-m-d H:i:s", $timestamp);

                $record = $dateTime . "|" . $sensor1 . "|" . $sensor2;
                SaveToFile($record, datalogFile);
                $register = [$dateTime, $sensor1, $sensor2];
                array_push($package, $register);
            }
        
            SaveToDb($package);

            http_response_code(200); //'OK'
            die();
        }
        catch (Exception $e)
        {
            BadRequest($e);
        }
    }
    BadRequest("Requisition was not made with POST");

    function SaveToDb($package)
    {   
        include("db/action.php");
        $recorded = addPackage($package);
        
        if($recorded == false) BadRequest("Not saved to DB.");
    }

    function CheckData($data, $i, $tag)
    {
        if(isset($data[dataTag][$i][$tag]))
        {
            return $data[dataTag][$i][$tag];
        }
        BadRequest("Data not set on " . $tag . ". Index: ". $i);
    }

    function GetDataSize($data)
    {
        if(!isset($data[dataTag])) BadRequest("Wrong JSON identification");
        $size = count($data[dataTag]);
        CheckSize($size);
        
        return $size;
    }

    function CheckSize($dataSize)
    {
        if($dataSize < packageLimitSize && $dataSize > 0) return;
        BadRequest("Wrong data size.");
    }

    function SaveToFile($record, $file)
    {
        file_put_contents($file, $record . "\n",FILE_APPEND);
    }

    function BadRequest($error)
    {
        $dt = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
        $now = $dt->format("d-m-Y h:i:s");
        
        SaveToFile($now ." - ". $error, errorlogFile);

        http_response_code(400); //'Bad Request'
        die();
    }
?>
