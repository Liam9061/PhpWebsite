<?php
 
$conn = "";
  
try {
    $servername = "localhost";
    $dbname = "'u261783350_traderater'";
    $username = "u261783350_liam9061";
    $password = "OwLm@n009";
  
    $conn = new PDO(
        "mysql:host=$servername; dbname=b1004066_db1",
        $username, $password
    );
     
   $conn->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 
?>


