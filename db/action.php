<?php
    function addRegistry($dateTime, $sensor1Value, $sensor2Value)
    {
        include_once("connection.php");
        $db = make_connection();

        $sql_request = "INSERT INTO datalog (date, s1, s2)
            VALUES ($dateTime, $sensor1Value, $sensor2Value)";
            
        $result = mysqli_query($db, $sql_request);
        close_connection($db);

        if($result == false)
        {
            return false;
        }

        return true;
    }
    
    function addError($dateTime, $description)
    {
        include_once("connection.php");
        $db = make_connection();

        $sql_request = "INSERT INTO errorlog (date, description)
            VALUES ('$dateTime', '$description')";
            
        $result = mysqli_query($db, $sql_request);
        close_connection($db);

        if($result == false)
        {
            return false;
        }

        return true;
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