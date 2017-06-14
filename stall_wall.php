<HEAD>
<TITLE>DUMP Project</TITLE>
<link rel="stylesheet" type="text/css" href="dump_style.css">
</HEAD>

<script type="text/javascript">
// isolates working directory of site, determines if it is the master or develop branch
// this is then used to select database accordingly
var path = document.location.pathname;
var js_branch_name = path.substring(path.indexOf('/', 1)+1, path.lastIndexOf('/'));
var js_result = js_branch_name.fontcolor("red");

window.onload = function() {
    //when the document is finished loading, replace everything
    //between the <a ...> </a> tags with the value of splitText
   document.getElementById("branch_name").innerHTML=js_branch_name;
}
//print indication in top left corner of page if this is a 
if (js_branch_name = "dump-develop") {
    document.write(js_result);
    }

</script>

<BODY BGCOLOR="WHITE">
<font face="courier">
<CENTER>
<H2>Stall Wall</H2>
<H4>"Here I sit broken hearted, paid a dime and only farted."</H4>
</CENTER>

<!-- BACK BUTTON -->
<button type="button" name="choose_back" id="back_button_small" value="choose_back" onclick="location.href='index.html'"/>
Back
</button>
<br><br><br>

<form action="write_wall.php" method="post">
  <H4>Write on the stall wall:</H4>
  Author: <input type="text" name="author1"><br><br>  
  Message: <br><textarea cols=50 rows="4" name="message1"></textarea><br><br>
  <button type="submit" name="choose_submit" id="write_it_button">Write it!</button>
</form>
<br>

<?php include('config.php');

    $username = USERNAME;
    $password = PASSWORD;
    $database = DATABASE;
    $tablename = TABLENAME_SW;
    $localhost = HOST;

    if (mysql_connect($localhost, $username, $password))
    {
    mysql_select_db($database) or die ("Unable to select database");
    } else {
    echo('Unable to connect to database.');
    }

     
    // 20.0 CREATE NAME ARRAY
    // 20.1 DETERMINE NUMBER OF NAMES IN TABLE SANDBOX_DUMP_DATA
    $query = mysql_query("SELECT date_time,author,body FROM $tablename ORDER by date_time DESC");
    if (mysql_num_rows($query) > 0) {
        // output raw data of each row
        //echo "On <strong>Date & Time</strong>";
        //echo str_repeat("&nbsp;", 13);
        //echo "<strong>Author</strong>";
        //echo str_repeat("&nbsp;", 5);
        //echo "<strong>Message</strong><br>";
        while($row = mysql_fetch_assoc($query)) {
            echo "<font color =\"green\">". $row["date_time"]. "</font>, ". "<font color=\"blue\">". $row["author"]. "</font> wrote:<br><br>". $row["body"]. "<br><br><br>";
    }
    } else {
        echo "0 results";
    }

?>

<br><br>
<center>
<font size="2">
<H4>Copyright 2017, by
<A>Mike Loose</A>
</H4>
</center>

</font>
</body>