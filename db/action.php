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
            
            $sql_request = "INSERT INTO datalog (date, s1, s2)
            VALUES ('$date', $sensor1, $sensor2)";
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

    function get_users()
    {                
        ?>
        <table border="1" cellpadding="10">
            <thead>
                <th>Id</th>
                <th>Username</th>
                <th>Nickname</th>
                <th>Registration</th>
            </thead>
            <tbody>
                <?php
                    include_once("connection.php");
                    $db = make_connection();
            
                    $sql_request = "SELECT * FROM users ORDER BY id DESC";
                    $users = $db->query($sql_request) or die($db->error);
                    
                    $num_users = mysqli_num_rows($users);
                    echo "users ammount:". $num_users;
                
                    if($num_users <= 0)
                    {
                        ?>
                            <td>
                                <td colspan="7">No records.</td>
                            </td>
                        <?php
                    }
                    else
                    {
                    while ($user = $users->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td><?php echo($user['id']) ?></td>
                            <td><?php echo($user['user_name']) ?></td>
                            <td><?php echo($user['nick_name']) ?></td>
                            <td><?php echo($user['registration_date']) ?></td>
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