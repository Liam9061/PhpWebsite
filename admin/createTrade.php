<!-- Bootstrap Css for nice looking form (Placed at top so header.html overrules it-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<?php


include("includes/admin_header.html");
require('includes/connect_db.php');
// Again PDO used instead of MySQLI used. 
$dbc = new PDO('mysql:host=localhost;dbname=u261783350_traderater', $user='u261783350_liam9061' , $pass='OwLm@n009' );
// When theres an error throw an exception
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];
// No Trade ID as that's auto incremented. The is just to define variables
$tradeName = '';
$tradeDesc = '';
// If loop for entering tradenames and trade descriptions 
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{

    $tradeName = $_POST['tradeName'];
    $tradeDesc = $_POST['tradeDesc'];
    

   
// Below is there to show errors.
    if (!$tradeName) 
    {
        $errors[] = 'Trade Name is required';
    }

    if (!$tradeDesc) 
    {
        $errors[] = 'Trade Description is required';
    }
// If errors are empty (no errors) Insers new row in Trade table and the pre defined variable tradename and trade description. Trade ID not needed as it auto increments
    if (empty($errors)) 
    {
        $statement = $dbc->prepare("INSERT INTO trade (tradeName, tradeDesc)
                VALUES (:tradeName, :tradeDesc)");
                //Bind values as despite them being same; Above just needs to be right in php. Tradename could be called different. $ signifies database variable
        $statement->bindValue(':tradeName', $tradeName);
        $statement->bindValue(':tradeDesc', $tradeDesc);
    
        // send to db
        $statement->execute();
        
    }

}


?>

<!doctype html>
<html lang="en">
  
<body>




<h1>Create new Trade Type</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Trade Name</label>
        <input type="text" name="tradeName" class="form-control" value="<?php echo $tradeName ?>">
    </div>
    <div class="form-group">
        <label>Trade description</label>
        <textarea class="form-control" name="tradeDesc"><?php echo $tradeDesc ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>