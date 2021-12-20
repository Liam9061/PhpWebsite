<?php
//if below does not exist. they are not logged in and redirected to login.php.
    if(!isset($_SESSION['user_level'])){
        header("Location: login.php");
    }

?>