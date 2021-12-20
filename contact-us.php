<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<?php
session_start();
if (isset($_SESSION['user_id'])) { 		// if the SESSION 'user_id' is  set get a different header which allows user to see their profile etc
	include('includes/home_header.html');
} else {
	include('includes/header.html');
}

?>

<div class="form">
	<h3>Contact - us</h3>

	<?php
	//below code to silence php warning messages.
error_reporting(0);
//checks all input boxes have been completed
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['comments'])) {

$body = "Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";
$body = wordwrap($body, 70);
//All submissions sent to the below email
mail('b1004066@my.shu.ac.uk', 'Contact Form Submission', $body, "From: {$_POST['email']}");
echo '<p><em>Thank you for contacting Trade Rater. We will respond to your enquiry in 48 hours.</em></p>'; //upon successful submission this is sent
$_POST = array();
}
else {
    echo '<p style="font-weight: bold; color: red">
              Please fill out the form completely.
          </p>';
	}




	?>

	<p>Please fill out this form to contact Trade Rater.</p>
	<form action="contact-us.php" method="post" class="form-signin" role="form">
		<table  class="table table-dark table-striped"width="80%"> 
			<tr>
				<td>Name: </td>
				<td><input type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></td>
			</tr>
			<tr>
				<td>Email Address: </td>
				<td><input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></td>
			</tr>
			<tr>
				<td>Contact Number: </td>
				<td><input type="tel" name="phone" size="30" maxlength="15" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" /></td>
			</tr>
			<tr>
				<td>Enquiry: </td>
				<td><textarea name="comments" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>
</div>		

<?php
include('includes/footer.html')
?>
