
<HEAD>
<TITLE>DUMP Project</TITLE>
<!-- STYLE SHEET REFERENCE (CSS) -->
<link rel="stylesheet" type="text/css" href="dump_style.css">
</HEAD>

<body BGCOLOR="WHITE">
<font face="verdana">

<!-- REPORT BUTTON -->
<button type="button" name="choose_report" id="menu_button" value="report" onclick="location.href='report.php'"/>
Redirect to Reports
</button>
<br><br><br><br>


<?php include('config.php');
// this is a copy of au2.php that I have modified to handle the dump upload tracker
// when uploading any data you have to put the PHP variable e.g. $n in quotes like this '$n'
// see line 31, or the one beginning with $query

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

/*
echo ($develop_branch);
echo ("<br>Development Branch: ");
echo $develop_branch ? 'true' : 'false';
echo ("<br>");

if (isset($_POST["client_date"]) && !empty($_POST["client_date"])) {
  echo "yes, client_date is set";
}else{
  echo "no, client_date is not set";
}
*/

$client_date_time = $_POST["client_date"];
$gmt_date_time = gmdate("Y-m-d H:i:s");


$dumper_name = $_POST["submit_btn"];
$success = "Congratulations ". $dumper_name . "! The time of this event has been recorded!";
$failture = "Uh-oh...something when wrong. This event has not been recorded.";


// EDIT: Your mysql database account information
$username = USERNAME;
$password = PASSWORD;
$database = DATABASE;
if ($develop_branch) {
  $tablename = TABLENAME_SBDD;
} else {
    $tablename = TABLENAME_DD;
}
$localhost = HOST;

// Check Connection to Database
if (mysql_connect($localhost, $username, $password))
  {
    mysql_select_db($database) or die ("Unable to select database");
 
    $query = "INSERT INTO $tablename (gmt_date_time, client_date_time, name) VALUES ('$gmt_date_time','$client_date_time','$dumper_name')";

  	$result = mysql_query($query);
  	if ($result) {
      echo '<script type="text/javascript">';
      echo 'alert("Congratulations!\n\nYour dump data has been successfully registered.")';
      //echo 'window.location="report.php"';
      echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Uh oh...something went wrong.\n\nDump data not registered.")';
        echo '</script>';

    } 


    // header("Location: report.php");
    exit();
    // ? $success : $failure;
  	//echo mysql_error();
   
        
  } else {
  	echo('Unable to connect to database.');
  }


