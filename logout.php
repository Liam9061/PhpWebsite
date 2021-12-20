<?php 
session_start();
//If user id isn't set - redirect to login page by calling load.
if (!isset($_SESSION['user_id'])) { 
    require ('login_tools.php');
    load();
}
include ('includes/header.html');
//clear session by making array ()
$_SESSION = array();
session_destroy();

// The below is showed upon logging out.
?>
<h1>Goodbye!</h1>
    <p>You are now logged out.</p>
    

<?php include ('includes/footer.php'); ?>

