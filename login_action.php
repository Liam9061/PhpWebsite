<?php 

// this is the 'action' from the form in login.php.
// this file includes 'login.php' at the end of the file, so if there's an error, the form is redisplayed.
// this file requires the connection file and login_tools.php which does all the validation
echo "in login action";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require ('includes/connect_db.php');
    require ('login_tools.php');
    echo "about to call validate";

    // list() function declares separates an array into its components.
	// here, the components are returned from the validate() function.
	//		the validate() function takes 3 arguments: 1) db connection object (dbc) 2) email from form('email') 3) password from form ['pass].
    list($check, $data) = validate($dbc, $_POST['email'], $_POST['pass']);
    echo "avalidation called";

    if ($check) {       // If true.....
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        echo "After last name";
        load ('home.php');
    }
    else { //If failed
        $errors = $data;
    }


    $dbc->close();
}
include ('login.php');
?>
