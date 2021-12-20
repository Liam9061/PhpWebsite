<?php
session_start();
require('includes/connect_db.php');
if (!isset($_SESSION['user_id'])) { 
    require ('login_tools.php'); 
    load();
}
    $page_title = "Welcome {$_SESSION['first_name']}"; 
    include('includes/home_header.html');



// Fetch information from Database , Especially the users below. Also checks the User Id is the same as the user ID of the logged in user.
// This is needed to show the  information from the database
$user_id=$_SESSION['user_id'];
$query=mysqli_query($dbc,"SELECT * FROM users where user_id='$user_id'")or die(mysqli_error($dbc));
$row=mysqli_fetch_array($query);


// Below was created to make it as simple as possible to edit in the future.
// Upon a final check I realised I'd not added availability and skills. this took 6 minutes in total to add here and to the View profile list.
//As well as editing this in action.php


?>


  <h1>User Profile</h1>
<div class="profile-input-field">
        <h3>Please Fill-out All Fields</h3>
        <form method="post" action="#" >
          <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" name="first_name" style="width:20em;" placeholder="Enter your Firstname" value="<?php echo $row['first_name']; ?>" required />
          </div>
          <div class="form-group">
            <label>Last name</label>
            <input type="text" class="form-control" name="last_name" style="width:20em;" placeholder="Enter your last name" required value="<?php echo $row['last_name']; ?>" />
          </div>
          <div class="form-group">
            <label>hourly_rate</label>
            <input type="double" class="form-control" name="hourly_rate" style="width:20em;" placeholder="00:00" value="<?php echo $row['hourly_rate']; ?>">
          </div>
          <div class="form-group">
            <label>previous_work</label>
            <input type="textarea" class="form-control" name="previous_work" style="width:20em;" required placeholder="Enter your previous worl" value="<?php echo $row['previous_work']; ?>"></textarea>
          </div>
          <div class="form-group">
            <label>Qualifications</label>
            <input type="textarea" class="form-control" name="qualifications" style="width:20em;" required placeholder="Enter your qualifications" value="<?php echo $row['qualifications']; ?>"></textarea>
          </div>
          <div class="form-group">
            <label>references</label>
            <input type="textarea" class="form-control" name="reference" style="width:20em;" required placeholder="Enter your references" value="<?php echo $row['reference']; ?>"></textarea>
          </div>
          <div>
          <div class="form-group">
            <label>skills</label>
            <input type="textarea" class="form-control" name="skills" style="width:20em;" required placeholder="Enter your skills" value="<?php echo $row['skills']; ?>"></textarea>
          </div>
          <div class="form-group">
            <label>Start Time</label>
            <input type="time" class="form-control" name="startTime" style="width:20em;" required placeholder="" value="<?php echo $row['startTime']; ?>"></textarea>
          </div>
          <div class="form-group">
            <label>End Time</label>
            <input type="time" class="form-control" name="endTime" style="width:20em;" required placeholder="" value="<?php echo $row['endTime']; ?>"></textarea>
          </div>
          <div>
          <label for="tradeName">trade Name</label>
          
          
          <?php
          // There is probably a more efficient way for me to do the below; However after countless hours spent on this (over a missing Apostrophe further down)
          // I really just wanted to get it working. It works and does everyhting I want of it. It takes information from a trades table I've built.
          // Please read the cover document if you want to edit some trades or add some trades for them to appear here to check if it works.
          // you should have a link and log in details in the cover document called FAO Jacky.
         
            $mysqli = NEW MySQLi('localhost','b1004066','owlman09','b1004066_db1');
            $user_id=$_SESSION['user_id'];
            $resultSet= $mysqli->query("SELECT tradeName FROM trade ");
            $rows=mysqli_fetch_array($resultSet);
          ?>
          <select name="tradeName" >
          
          <?php
          while ($rows = $resultSet->fetch_assoc())
          {
            $tradeName = $rows['tradeName'];
            echo "<option value='$tradeName' >$tradeName</option>";
          }
          ?>
        </select>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
            
          </div>
        </form>
      </div>
      </html>
      <?php

      // Below submits the above information which is posted in my profile.
      // Again there may be a more efficient way of doing this but it's the simplest way of changing what's on this page 
      // you add the information above in the form, then add it below.
      if(isset($_POST['submit'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $hourly_rate = $_POST['hourly_rate'];
        $previous_work = $_POST['previous_work'];
        $qualifications = $_POST['qualifications'];
        $reference = $_POST['reference'];
        $skills = $_POST['skills'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $tradeName = $_POST['tradeName'];

        //Below takes information above and updates the information in the database , which is then shown in the view users section
    
      $query = "UPDATE users SET first_name = '$first_name',
                      last_name = '$last_name', hourly_rate = $hourly_rate, previous_work = '$previous_work',qualifications = '$qualifications',reference = '$reference', 
                      skills = '$skills' , startTime= '$startTime' , endTime= '$endTime', tradeName = '$tradeName'
                      WHERE user_id = '$user_id'";
                    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "home.php";
        </script>
        <?php
             }               
?>





<?php include ('includes/footer.php');
?>

