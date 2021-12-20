<?php

$page_title = 'Display tradesmen';
include('includes/header.html');
require('includes/connect_db.php');

?>
<!DOCTYPE html>


<h1>search page</h1>

<?php
//Below is the main part of how my automatic search function work. It takes an AJAx query from view users. I have used LIKE instead of exact as qualifications
// are entered by the tradesman themselves. The tradesman I know are about as good at spelling and grammar as myself :) 
//It can lead to too many searched being shown however it'll take 60 seconds to change to = 
//Oh and an example of how easy it would be to add ot the below. I would just have to copy whatever is inside the quotes"OR previous_work LIKE '%$search%'" 
// and change previous_work to whatever the title of column is in my database. It really is that easy. Oh and add it in the table below that


if(isset($_POST['submit_search'])){
  $search = mysqli_real_escape_string($dbc, $_POST['search']);
  $sql = "SELECT * FROM users where user_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR 
  email LIKE '%$search%' OR username LIKE '%$search%'OR tradeName LIKE '%$search%'OR reference LIKE '%$search%'OR 
  hourly_rate LIKE '%$search%'OR qualifications LIKE '%$search%'OR previous_work LIKE '%$search%' OR skills LIKE '%$search%' OR startTime LIKE '%$search%'OR endTime LIKE '%$search%'";  
  $result = mysqli_query($dbc, $sql);
  $queryResult = mysqli_num_rows($result);

  // Below is the new search results which show on view users. 
  if($queryResult > 0){
    while ($row=mysqli_fetch_assoc($result)) {
      echo "<tr>
    <td>".$row['user_id'] ."</td>
    <td>".$row['first_name'] ."</td>
    <td>".$row['last_name'] ."</td>
    <td>".$row['email'] ."</td>
    <td>".$row['username'] ."</td>
    <td>".$row['tradeName'] ."</td>
    <td>".$row['reference'] ."</td>
    <td>".$row['hourly_rate'] ."</td>
    <td>".$row['qualifications'] ."</td>
    <td>".$row['previous_work'] ."</td>
    <td>".$row['skills'] ."</td>
    <td>".$row['startTime'] ."</td>
    <td>".$row['endTime'] ."</td>
		</tr>";

    }
  } else{
    echo "There are no results matching your search!";
  }
}

?>

<?php
/*
$sql = "SELECT * FROM users";
$result = mysqli_query($dbc,$sql);
$queryResults = mysqli_num_rows($result);

if ($queryResults > 0) {
while ($row = mysqli_fetch_assoc($result)) {
   echo "<tr>
    <td>".$row['user_id'] ."</td>
    <td>".$row['first_name'] ."</td>
    <td>".$row['last_name'] ."</td>
    <td>".$row['email'] ."</td>
    <td>".$row['username'] ."</td>
    <td>".$row['tradeName'] ."</td>
    <td>".$row['reference'] ."</td>
    <td>".$row['hourly_rate'] ."</td>
    <td>".$row['qualifications'] ."</td>
    <td>".$row['previous_work'] ."</td>
		</tr>";
 

}
}
*/
?>


</body>
</html>