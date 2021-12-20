<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>



<body>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) { 
    require ('login_tools.php'); 
    load();
}
    $page_title = "Welcome {$_SESSION['first_name']}"; 
    include('includes/home_header.html');


echo "<h1 id='mainhead'>Trade Rater</h1>;
    <p>
    You are now logged in, {$_SESSION['first_name']} {$_SESSION['last_name']}
    </p>";

?>
<br>

<p> We advise that you keep your profile up to date: To do so please click <a href="my_profile.php">here</a> </p>

<div class="container">
    <div class="container">
        <img src="img/hammer.jpg" height="200" width="200"/>
        
    </div>
    <div class="container">
        <img class="middle-img" src="img/screwdriver.jpg" height="200" width="200"/>
       
    </div>
    <div class="container">
         <img src="img/spanner.jpg" height="200" width="200"/>
       
    </div>
</div>
</body>


<?php echo"\n \n \n \n \n \n \n \n \n \n"; 
include ('includes/footer.php');
?>

</html>