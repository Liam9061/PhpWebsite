<!doctype html>
<head>
  <title>Review</title>
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/starrr.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src='Js/starrr.js'></script>
    
</head>
<?php 

session_start();
if (isset($_SESSION['user_id'])) { 		// if the SESSION 'user_id' is  set...
	include('includes/home_header.html');
} else {
	include('includes/header.html');
}




require('includes/connect_db.php');
// Fetech all information from users
 $result = mysqli_query($dbc, "SELECT * FROM users");
 while($row = mysqli_fetch_object($result)) {
     $result_ratings = mysqli_query($dbc,"SELECT * FROM ratings WHERE user_id = '" . $row->user_id ."'");
     //Set ratings at 0 , then run a loop on all ratings so an average can be made
     $ratings = 0;
     while($row_ratings = mysqli_fetch_object($result_ratings)) 
     {
         $ratings += $row_ratings->ratings;
     }
     // If no ratings have been given their average will be 0 so it's a good starting point. Form this we can loop and work out average
    $average_ratings = 0;
    if($ratings>0)
    {
        $average_ratings = $ratings / mysqli_num_rows($result_ratings);
    }

 
?>

<p> Average Rating : </p> <div class="ratings" data-rating="<?php echo $average_ratings; ?>"></div>

<p>
Name: <?php
echo $row->first_name;
?>
<?php
echo  $row->last_name;
?>
</p>

<form method="POST" onsubmit="return saveRatings(this);">
    <input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>">

<p>
Your Rating: <div class="starrr"></div>
    
</p>
<input type="submit">
</form>
<hr>
<hr>




<?php
 }
?>

<script>
var ratings = 0;
$(function() {
    $(".starrr").starrr().on("starrr:change", function (event, value) {
        //alert(value);
        ratings=value;
    });
   var rating = document.getElementsByClassName("ratings");
   for (var a = 0; a< rating.length; a++)
   {
       $(rating[a]).starrr({
           readOnly: true,
           rating: rating[a].getAttribute("data-rating")
       })
   } 
    
});
function saveRatings(form) {
    var user_id = form.user_id.value;
    $.ajax({
        url:"save-ratings.php",
        method:"POST",
        data: {
            "user_id": user_id,
            "ratings": ratings
        },
        success: function (response){
            alert(response);
        }

    })
    return false;
}
</script>