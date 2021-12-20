<?php
 
$conn = "";
  
try {
    $servername = "localhost";
    $dbname = "'hidden'";
    $username = "hidden";
    $password = "hidden";
  
    $conn = new PDO(
        "mysql:host=$servername; dbname=hidden",
        $username, $password
    );
     
   $conn->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 
?>


