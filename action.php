<?php
include 'includes/connect_db.php';
$output='';

//Below is the main part of how my automatic search function work. It takes an AJAx query from view users. I have used LIKE instead of exact as qualifications
// are entered by the tradesman themselves. The tradesman I know are about as good at spelling and grammar as myself :) 
//It can lead to too many searched being shown however it'll take 60 seconds to change to = 
//Oh and an example of how easy it would be to add ot the below. I would just have to copy whatever is inside the quotes"OR last_name LIKE CONCAT('%',?,'%')'" 
// and change last_name to whatever the title of column is in my database. add an s or i  under bind param for whether it's a string or int and add an extra $search
//  It really is that easy. Oh and add it in the table below that
if(isset($_POST['query'])){
    $search = $_POST['query'];
    $statement=$dbc->prepare("SELECT * FROM users WHERE  first_name LIKE CONCAT('%',?,'%') OR last_name LIKE CONCAT('%',?,'%') OR 
  email LIKE CONCAT('%',?,'%')  OR tradeName LIKE CONCAT('%',?,'%') OR reference LIKE CONCAT('%',?,'%')OR 
  hourly_rate LIKE CONCAT('%',?,'%')OR qualifications LIKE CONCAT('%',?,'%')OR previous_work LIKE CONCAT('%',?,'%') 
  OR skills LIKE CONCAT('%',?,'%') OR startTime LIKE CONCAT('%',?,'%') OR endTime LIKE CONCAT('%',?,'%') ORDER BY qualifications DESC");
  $statement->bind_param("sssssisssss" , $search,$search,$search,$search,$search,$search,$search,$search,$search,$search,$search);
}
else{
    $statement=$dbc->prepare("SELECT * FROM users");

}
$statement->execute();
$result=$statement->get_result();

if($result->num_rows>0){
    $output = 
"<thead>
    <tr>
        <th>First Name</th>
		<th>Last Name</th>
		<th>email</th>
		
		<th>trade type</th>
		<th>reference</th>
		<th>hourly rate</th>
		<th>qualifications</th>
        <th>previous work</th>
        <th>Skills</th>
        <th>Start Time</th>
        <th>End Time</th>

    </tr>
</thead>
<tbody>";
    while($row=$result->fetch_assoc()){
        $output .="
    <tr>
        
        <td>".$row['first_name'] ."</td>
        <td>".$row['last_name'] ."</td>
        <td>".$row['email'] ."</td>
        
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
    $output .="</tbody>";
    echo $output;
}
else{
    echo"<h3>No Tradesman found</h3>";
}
?>