<?php
    function addPackage($package)
    {
        include_once("connection.php");
        $db = make_connection();

        for($i = 0 ; $i < count($package); $i++)
        {
            $date = $package[$i][0];
            $sensor1 = $package[$i][1];
            $sensor2 = $package[$i][2];
            $sensor3 = $package[$i][3];
            
            $sql_request = "INSERT INTO datalog (date, s1, s2, s3)
            VALUES ('$date', $sensor1, $sensor2, $sensor3)";
            $result = mysqli_query($db, $sql_request);

            if($result == false)
            {
                close_connection($db);
                return false;
            }
        }

        close_connection($db);
        return true;
    }

    function showRecords()
    {                
        ?>
        <table border="1" cellpadding="10">
            <thead>
                <th>Date</th>
                <th>Sensor 1</th>
                <th>Sensor 2</th>
                <th>Sensor 3</th>
            </thead>
            <tbody>
                <?php
                    include_once("connection.php");
                    $db = make_connection();
            
                    $sql_request = "SELECT * FROM datalog ORDER BY date DESC";
                    $records = $db->query($sql_request) or die($db->error);
                    
                    $num_records = mysqli_num_rows($records);
                    echo "total:". $num_records;
                
                    if($num_records <= 0)
                    {
                        ?>
                            <td>
                                <td colspan="7">No records.</td>
                            </td>
                        <?php
                    }
                    else
                    {
                    while ($record = $records->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td><?php echo($record['date']) ?></td>
                            <td><?php echo($record['s1']) ?></td>
                            <td><?php echo($record['s2']) ?></td>
                            <td><?php echo($record['s3']) ?></td>
                        </tr>
                        <?php
                    }
                ?>
                <?php }
            ?>

            </tbody>

        </table>

        <?php

        close_connection($db);
    }
    
?>