<?php
// this page contains two functions - Load and valudiate. Both are called from login_action. 



function load($page = 'login.php'){  
    //Server contains server IP , 
    $url = 'http://' . $_SERVER ['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    $url = rtrim( $url, '/\\' ) ;
$url .= '/' . $page ;
header("Location: $url"); 
// exits the current script
    exit();
}
//called form login_action with form details as arguments
function validate($dbc, $email = '', $pwd = '')
{
    echo "Begininning of validation";
    $errors = array() ;
    
    if (empty($email)) {
        $errors[] = 'Enter your email address. .'; 
        echo "Enter your email address. ";
    } else {
        $e = $dbc->real_escape_string(trim($email));
    }

    if (empty($pwd)) {
        $errors[] = 'Enter your password. .';
        echo "Enter your password. ";
    } else {
        $p = $dbc->real_escape_string(trim($pwd));
    }

    if (empty($errors)) {
        $q = "SELECT user_id, first_name, last_name  FROM users WHERE email='$e' AND pass=SHA1('$p')";  
        $r = $dbc->query($q);
        if ($r->num_rows == 1) 
        {    
            /// using fetch_array() with MYSQLI_ASSOC formats the result set as an 'associative' array - one that uses column names as keys instead of numbers
			// eg $row['user_id'] and $row['first_name'] instead of $row[0] and $row[1]
            echo "1 row forund";                           
            $row = $r->fetch_array(MYSQLI_ASSOC);
            return array(true, $row); //if found return success
        } else { 
            $errors[] = 'Email address and password not found.'; 
        }
        
    }

    return array( false, $errors );  //ifnot there are errors
}
