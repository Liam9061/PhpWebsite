<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php
include ("includes/header.html")

?>
<?php
if (isset($errors) && !empty($errors))
{
    echo '<p id="err_msg">Oops! There was a problem:<br>';
    foreach ($errors as $msg) { 
        echo " - $msg<br>";
    }
    echo 'Please try again or <a href="register.php">Register</a></p>';
}

?>

<!-- Display login form -->
<form action="login_action.php" method="post" class="form-input-material" role="form">

	<h2 class="form-signin-heading">Please login</h2>
    <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Email address</label>
    <input type="text" name="email" placeholder="Email Address" class="form-control-material">
    </div>
    <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Password</label>
    <input type="password" name="pass" placeholder="Password" class="form-control-material">
    </div>
	<p><button class="btn btn-primary btn-ghost" name="submit" type="submit">Login</button></p>
	<small><a href="password.php">Reset Password?</a></small>

</form>

<?php
include "includes/footer.html"
?>
