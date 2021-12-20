 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
<?php


include("includes/admin_header.html");
require('includes/connect_db.php');


// Below was created out of error really, I learned a different way of setting up a DBC and this was PDO
//Only did it the below way as I tried loads of times to get it to work. Realised i missed an apostrophe near the bottom when earlier the pre-learned method
//didn't work
$dbc = new PDO('mysql:host=localhost;dbname=b1004066_db1', $user='u261783350_liam9061' , $pass='OwLm@n009' );
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Below has defined the variables to help with them showing later on

$tradeID='';
$tradeName = '';
$tradeDesc = '';

$tradeID = $_GET['tradeID'] ?? null;

if (!$tradeID) {
    header('Location: trades.php');
    exit;
}
// Statement to select all from trade where tradeID is Trade ID
$statement = $dbc->prepare('SELECT * FROM trade WHERE tradeID = :tradeID');
$statement->bindValue(':tradeID', $tradeID); //Binds trade ID with Trade ID
$statement->execute();
$trades = $statement->fetch(PDO::FETCH_ASSOC); //Fetch associates

//Define variable with wither DB names
//used $trades as it's simmilar to db name trade and didn't want to cause a conflicing issue with the same name
$tradeID = $trades['tradeID'];
$tradeDesc = $trades['tradeDesc'];
$tradeName = $trades['tradeName'];


// From the Trade ID which is already found, Define other variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{

    $tradeName = $_POST['tradeName'];
    $tradeDesc = $_POST['tradeDesc'];
    
    //Edit Tradename and trade desc to the matching Trade ID. Then bind the values wiht the their database name (named same to make it easier)
    if (empty($errors)) {
        $statement = $dbc->prepare("UPDATE trade SET tradeName = :tradeName, 
                                        
                                        tradeDesc = :tradeDesc 
                                        WHERE tradeID = :tradeID");
        $statement->bindValue(':tradeName', $tradeName);
       
        $statement->bindValue(':tradeDesc', $tradeDesc);
        
        $statement->bindValue(':tradeID', $tradeID);

        $statement->execute();
        header('Location: trades.php');
    }

}

?>
<!doctype html>
<html lang="en">
<head>


  
  
</head>
<body>
       
  <!-- back to trades button -->
<p>
    <a href="trades.php" class="btn btn-default">Back to Trades</a>
</p>
<h1>Update Trade: <b><?php echo $trades['tradeName']  //update trade (trade name)?></b></h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <!-- below shows the name and descriptions from database. it's also availble to be edited . information then entered here should go to DB -->
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