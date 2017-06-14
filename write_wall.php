<html>
    <head>
        <meta charset="UTF-8">
        <title>DUMP Project</title>
    </head>
    <body>
        <?php include('config.php');
   
        
        //echo $_POST['message1'];
        $m1 = $_POST['message1'];
        //echo $_POST['author1'];
        $a1 = $_POST['author1'];

        $username = USERNAME;
        $password = PASSWORD;
        $database = DATABASE;
        $tablename = TABLENAME_SW;
        $localhost = HOST;

        if (mysql_connect($localhost, $username, $password))
        {
        mysql_select_db($database) or die ("Unable to select database");

        // Next two lines will write into your table 'test_table_name_here' with 'yourdata' value from the arduino and will timestamp that data using 'now()'
   
        $query = "INSERT INTO $tablename (date_time, author, body) VALUES (now(),'$a1','$m1')";
        $result = mysql_query($query);
        echo $result ? $success : $failure;
        echo mysql_error();
        } else {
        echo('Unable to connect to database.');
        }

        header("Location: stall_wall.php"); /* Redirect browser */
    

        ?>
    </body>
</html>
