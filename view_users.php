<!-- BootStrap at the top: This means my CSS which is in home_header.html can keep my nav bar at the top. With this I've added easier functionality for tablets, phones and narrow windowed browsers -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php

$page_title = 'Display tradesmen';

session_start();
if (isset($_SESSION['user_id'])) { 		// if the SESSION 'user_id' is  set...
	include('includes/home_header.html');
} else {
	include('includes/header.html');
}
require('includes/connect_db.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
  
</head>
<body class="contacts-page" >
   

<div class="container-fluid">
<div class = "row justify-content-cener">
<div class="col-md-10 bg-light mt-2 rounded pb-3">
    <div class="contacts-page">

    <h1 color="black"> Tradesman search </h1>

    <hr>
    <div class="form-inline">
        <label for="search" class="font-weight-bold"> Search Tradesman </label>&nbsp;&nbsp;
        <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0" placeholder="search">
    
    </div>
    <hr>
    <?php
    // Add SQL Query to tetrieve all users from the database table users
    $statement=$dbc->prepare("SELECT*FROM users ORDER BY qualifications DESC");
    $statement->execute();
    $result=$statement->get_result();

    // I could select specific columns but it would make it more difficult and painful to edit further down the line
    // For example below. You add an extra table heading. insert the heading. then in data you copy a data row and repalce the [''] with whatever
    //The name of the row is in the folder. For search purporses you have to go into action.php and add the code in there and Voila done. Easy to 
    //replicate and add anything you want to this table
    // For example , I forgot to add Skills, Start time and End time to the my profile and view users table, the total time it took me to add to DB,
    // Enter into my Profile , add to the table in view users and tweak the search box was 6 minutes.


    ?>
    <table class="table table-dark table-hover" id="table-data">
      <!-- Info for adding or deleting information ... Table headers go here -->        
       <thead>
           <tr>
        
		<th>First Name</th>
		<th>Last Name</th>
		<th>email</th>
		
		<th>Trade type</th>
		<th>Reference</th>
		<th>Hourly rate</th>
		<th>Qualifications</th>
        <th>Previous work</th>
        <th>Skills</th>
        <th>Start Time</th>
        <th>End Time</th>
        </tr>
       </thead> 
       <tbody>
           <?php 
           // Fetch all the records by looping through the returned array, print each on a new table row, and close the table
           while($row=$result->fetch_assoc()){ ?>
            <tr>
               
                <td> <?= $row['first_name']; ?></td>
                <td> <?= $row['last_name']; ?></td>
                <td> <?= $row['email']; ?></td>
                
                <td> <?= $row['tradeName']; ?></td>
                <td> <?= $row['reference']; ?></td>
                <td> <?= $row['hourly_rate']; ?></td>
                <td> <?= $row['qualifications']; ?></td>
                <td> <?= $row['previous_work']; ?></td>
                <td> <?= $row['skills']; ?></td>
                <td> <?= $row['startTime']; ?></td>
                <td> <?= $row['endTime']; ?></td>
                
            </tr>
            <?php } ?>
       </tbody>

    </table>
    </div>
</div>
</div>

</div>
</body>
<!-- the below is the main reason the search function works as it does. It links into functions.php . 
this searches simmilar results. The reasoning behind this is a lot of information is typed by the tradesman. they may not have the best spelling. -->  
   <script type="text/javascript">
$(document).ready(function(){
$("#search_text").keyup(function(){
	var search =$(this).val();
	$.ajax({
		url:'action.php',
		method: 'post',
		data:{query:search},
		success:function(response){
			$("#table-data").html(response);
		}
	})
})
});
</script>
 
</body>
</html>
