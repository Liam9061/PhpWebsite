<!-- Bootstrap goes before everything else so later styles can override -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<?php
$page_title = 'trades';

include("includes/admin_header.html");

require('includes/connect_db.php');


$dbc = new PDO('mysql:host=localhost;xxxxxxxxxxxxxxx', $user='xxxxxxxxxxx' , $pass='xxxxxxxxxxxx' );
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Select all from Trades and order them by tradeID
$statement = $dbc->prepare('select * FROM trade ORDER BY tradeID ASC');
$statement->execute();
$trades = $statement->fetchAll(PDO::FETCH_ASSOC);



?>

<body>

<h1>Trade Types</h1>
<form>
  <!-- This will be the button top left of trade table that directs to create Trade -->
  <a href="createTrade.php" class="btn btn-success"> Create Trade Type</a>
</form>
<br>




<table class="table table-dark table-striped">
  <thead>
    
    <tr>
      <!-- Table headers go here -->
      <th scope="col">Trade ID</th>
      <th scope="col">Trade Type</th>
      <th scope="col">Trade Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <!-- With the use of for each new rows are added form the database-->
    <?php foreach ($trades as $t =>$trade){ ?>
      <tr>
      <th scope="row"><?php echo $trade['tradeID'] ?></th>
      <td><?php echo $trade['tradeName'] ?></td>
      <td><?php echo $trade['tradeDesc'] ?></td>
      <td>
        <!-- Below is the row for action which contains edit trade and delete trade. these use the tradeID of the row to determine what they edit or delete -->
      <a href="editTrade.php?tradeID=<?php echo $trade['tradeID']?>" class="btn btn-sm btn-dark">Edit</a>
      

      <form style="display: inline-block" method="post" action="deleteTrade.php">
      <input type="hidden" name="tradeID" value="<?php echo $trade['tradeID']?>">
      <button type="submit" class="btn btn-sm btn-dark">Delete</button>
      </form>

      </td>
    </tr>

    <?php } ?>
    
  </tbody>
</table>
</body>

