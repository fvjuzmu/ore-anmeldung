<?php
//$dbh = new PDO('mysql:host=', '', '');
include("db_connect.inc.php");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare("SELECT * FROM ore WHERE cdatefrom > :cdate ORDER BY cdatefrom ASC LIMIT 0,1");
$datum = date('Y-m-d');
$stmt->bindParam(':cdate', $datum);
if(!$stmt->execute())
{
           die("Error: Keinen Termin f&uuml; die n&auml;chste Ortsranderholung gefunden.");
}

$ORE = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;
?>