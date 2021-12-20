<!-- below is going to connect to the database, it will mean you can register your account -->
<?php
include("includes/header.html")
?>

<?php 
// Check's if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('includes/connect_db.php');  // include file and fail if file is missing
    $errors = array();
    if (empty($_POST['username'])) {
    $errors[] = 'Enter your username.'; 
} else {  // this function checks the charset of the database ($dbc) and formats the given string accordingly (see connect_db.php)
			  // (The @ symbol suppresses errors)
    $un = $dbc->real_escape_string(trim($_POST['username'])); 
}

if (empty($_POST['first_name'])) {
    $errors[] = 'Enter your first name.'; 
} else {
    $fn = $dbc->real_escape_string(trim($_POST['first_name'])); 
}
	if (empty($_POST['last_name'])) {
    $errors[] = 'Enter your last name.'; 
} else {
    $ln = $dbc->real_escape_string(trim($_POST['last_name'])); 
}
	if (empty($_POST['email'])) {
    $errors[] = 'Enter your email address.'; 
} else {
    $e = $dbc->real_escape_string(trim($_POST['email'])); 
}
if (!empty($_POST[ 'pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) { 
	        $errors[] = 'Passwords do not match.'; 
	    }
	    else { 
	        $p = $dbc->real_escape_string(trim($_POST['pass1']));
	    }
	} else {
	    $errors[] = 'Enter your password.';
	}

if (empty($errors)) 
{
    $q = "SELECT user_id FROM users WHERE email='$e'";
    $r = $dbc->query($q);
    $rowcount = $r->num_rows;
    if ($rowcount != 0){
        $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ; 
    } 
    
}
if (empty($errors)) 
{
    $q = "SELECT user_id FROM users WHERE username='$un'";
    $r = $dbc->query($q);
    $rowcount = $r->num_rows;
    if ($rowcount != 0){
        $errors[] = 'username already registered. <a href="login.php">Login</a>' ; 
    } 
    
}

if (empty($errors)) {
    $q = "INSERT INTO users (username,first_name, last_name, email, pass, reg_date) 
                     VALUES ('$un', '$fn', '$ln', '$e', SHA1('$p'), NOW() )";
    $r = $dbc->query($q);
    if ($r) { 
        echo '<h1>Registered!</h1>
            <p>You are now registered.</p>
            <p><a href="login.php">Login</a></p>'; 
    }
    $dbc->close();
    include ('includes/footer.html'); 
    exit();
}
else {
    echo '<h1>Error!</h1>
         <p id="err_msg">The following error(s) occurred:<br>';
    foreach ($errors as $msg) {
        echo " - $msg<br>";
    }
    echo 'Please try again.</p>';
    $dbc->close();
}  
}
?>


<!-- Display body section with  form. -->
<form action="register.php" method="post" class="form-signin" role="form">
    <h2 class="form-signin-heading">Create an Account</h2>
    <input type="text" name="username" size="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" placeholder="username">
	<input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" placeholder="First Name"> 
    <input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" placeholder="Last Name">
	<input type="text" name="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email Address">
	<input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" placeholder="Password">
	<input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" placeholder="Confirm Password">
	<p><button class="btn btn-primary" name="submit" type="submit">Register</button></p>
</form>

<?php
include("includes/footer.html")
?>