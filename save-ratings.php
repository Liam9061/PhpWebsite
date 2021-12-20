<?php

require('includes/connect_db.php');

$user_id = $_POST["user_id"];
$ratings = $_POST["ratings"];
 

 
mysqli_query($dbc, "INSERT INTO  ratings (user_id, ratings) VALUES ('$user_id', '$ratings')");
 
// whatever you echo here, will be displayed in alert on user side
echo "Saved";