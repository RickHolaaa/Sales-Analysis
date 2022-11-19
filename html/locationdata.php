<?php
//setting header to json
header('Content-Type: application/json');

include('config.php');
include("auth_session.php");
//query to get data from the table

//$query = sprintf("SELECT avis,id_jours FROM jours_vendeur WHERE id_vendeur='$id_vendeur'");
$query = sprintf("SELECT * FROM location where NameWoDiac in (SELECT pays from client where id in (SELECT id_client FROM client_vendeur where id_vendeur in (SELECT id FROM VENDEUR WHERE username='".$_SESSION['username']."')))");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);