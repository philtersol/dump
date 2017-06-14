<?php
// following script to be included at start of every php page for the site
// isolates working directory of site, determines if it is the master or develop branch
// this is then used to select database accordingly

$dir = getcwd();
$dir_parse = substr($dir, -12);
//echo $dir_parse;
//print indication in top left corner of page if this is the dump-develop branch
if ($dir_parse == "dump-develop") {
    echo ("<font color=\"red\">" . $dir_parse. "</font><br><br>");
    $develop_branch = true;
} else {
    $develop_branch = false;
}
?>


<html>
<head>
<meta charset="UTF-8">
<title>DUMP Project</title>
<link rel="stylesheet" type="text/css" href="dump_style.css">
</head>
<body>

<!-- BACK BUTTON -->
<button type="button" name="choose_back" id="back_button_small" value="choose_back" onclick="location.href='index.html'"/>
Back
</button>
<br><br><br>



<?php include('config.php');

$username = USERNAME;
$password = PASSWORD;
$database = DATABASE;
if ($develop_branch) {
  $tablename = TABLENAME_SBDD;
} else {
    $tablename = TABLENAME_DD;
}
$localhost = HOST;

if (mysql_connect($localhost, $username, $password))
{
mysql_select_db($database) or die ("Unable to select database");
} else {
echo('Unable to connect to database.');
}
 
// 20.0 CREATE NAME ARRAY
// 20.1 DETERMINE NUMBER OF NAMES IN TABLE SANDBOX_DUMP_DATA
$query = mysql_query("SELECT gmt_date_time,client_date_time,name FROM $tablename ORDER by gmt_date_time DESC");
$total_rows = mysql_num_rows($query);
if (mysql_num_rows($query) > 0) {
    // output raw data of each row
    echo "<strong>Dump</strong>";
    echo str_repeat("&nbsp;", 5);
    echo "<strong>GMT date & time</strong>";
    echo str_repeat("&nbsp;", 11);
    echo "<strong>Local date & time</strong>";
    echo str_repeat("&nbsp;", 14);
    echo "<strong>Name</strong><br>";
    echo str_repeat("&nbsp;", 5);
    echo "<strong>#</strong>";
    echo str_repeat("&nbsp;", 9);
    echo "(chronological order)";
    echo str_repeat("&nbsp;", 7);
    echo "(Dumper's local time)<br>";
    echo str_repeat("-", 85);
    echo "<br>";
    $count = $total_rows;
    while($row = mysql_fetch_assoc($query)) {
    	echo str_repeat("&nbsp;", 4). $count. str_repeat("&nbsp;", 8). $row["gmt_date_time"]. str_repeat("&nbsp;", 7). $row["client_date_time"]. str_repeat("&nbsp;", 12). $row["name"]. "<br>";
    	--$count;
    }
    } else {
        echo "0 results";
    }
    
/*

    // 20.2 LOAD SENSOR LOCATION INTO ARRAY
    // $sensor_location uses array index as the sensor_id number
    $sensor_location = array();
    $query_1 = mysql_query("SELECT id,location FROM $tablename");
    
    while ($row = \mysql_fetch_assoc($query_1))
    {
        $sensor_location[$row['id']] = $row["location"];
    //    echo "ID:$row[id]......Location: $row[location]<br>";            
    }   
    
    // 30.0 GET TEMPERATURE DATA
    // 30.10 CREATE ARRAY FOR STORING DATA
    // $sensor_data uses index as the sensor_id number
    $date_time = array();
    $id = array();
    $data = array();
    $location = array();
    $usn = array();
    // 30.20 CHANGE TABLE NAME TO MASTER DATA TABLE
    $tablename = "temp_data_1";
    // 30.30 SET UP LOOP TO DO QUERIES FOR DATA
    
    echo "mvProjects Temperature<br>";
    echo date("D M d, Y"); 
    echo "<br>"; 
    echo date("G:i a");
    echo "<br><br>";
    for ($i = 0; $i < ($max_sensor_id + 1); $i = $i + 1) 
    // the code below is an improvement over tds1; loads in ~2s instead of ~5s
    {
        $query_2 = mysql_query("SELECT
                *
                FROM $tablename AS t
                WHERE id = $i
                ORDER BY date_time DESC
                LIMIT 1");
        if (!$query_2)
        {
            echo "Could not run query." . mysql_error();
            exit;
        }
        $row = mysql_fetch_row($query_2);
        //echo "$row[0]...$row[1]...$row[2]<br>";
        $date_time[$i] = $row[0];
        $id[$i] = $row[1];
        $data[$i] = $row[2];
        $location[$i] = $row[3];
        $usn[$i] = $row[4];
        echo "$location[$i]...$data[$i]<br>";
    }
    echo "<br><br>";
    echo "Arduino Upload Diagnostics<br><br>";
    for ($i = 0; $i < ($max_sensor_id + 1); $i = $i + 1) 
    {
        
        echo "$id[$i]...$location[$i]...$date_time[$i]...";
        echo "$data[$i]...$usn[$i]<br>";
    }
*/
?>

</body>
</html>
