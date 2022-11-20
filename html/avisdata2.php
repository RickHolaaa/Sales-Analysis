<?php 
//setting header to json
include("auth_session.php");
header('Content-Type: application/json');

include('config.php');

//query to get data from the table




$data = mysqli_query($mysqli,"SELECT id as id_user FROM vendeur WHERE username='".$_SESSION['username']."'") or die(mysql_error());
$row = mysqli_fetch_assoc($data);
$id = $row['id_user'];

$val=$_SESSION['jours'];
echo $_SESSION['jours'];
$query = sprintf("SELECT prenom,avis from client where id in (SELECT jours_client.id_client from jours_client,client_vendeur where id_vendeur=$id && id_jours=$val && client_vendeur.id_client=jours_client.id_client)");


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
?>
