# dump
Community dump tracker.

Files comprise a website for tracking an event. In this case it is designed to track when someone takes a dump.
Project is for learning and a few laughs, afterall, everybody knows that good health starts with a healthy bowel, and if you don't have big data on your side, it is unlikely that you will have a healthy bowel.

A config.php file is required to make the mysql link work. I used a format like this:

<?php
define('USERNAME', 'myusername');
define('PASSWORD', 'mypassword');
define('DATABASE', 'mydatabase');
define('TABLENAME', 'mytablename');
define('HOST', 'myhost');
?>
