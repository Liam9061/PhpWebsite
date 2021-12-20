<?php
//Again you see PDO - Again I tried the way learned and thought that was erroring however I found out an apostrophe was missing. As this worked I stuck with it
$dbc = new PDO('mysql:host=localhost;dbname=xxxxxx', $user='xxxxxxxx' , $pass='oxxxxxxxxxx' );
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tradeID = $_POST['tradeID'] ?? null;

if (!$tradeID) {
    header('Location: index.php');
    exit;
}
//Deletes the trade where TradeID = Trade ID. This is the primary key for trades
$statement = $dbc->prepare('DELETE FROM trade WHERE tradeID = :tradeID');
$statement->bindValue(':tradeID', $tradeID);
$statement->execute();

header('Location: trades.php');
