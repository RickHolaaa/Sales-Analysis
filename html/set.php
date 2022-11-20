<?php
// start the session
session_start();
include('config.php');
// set the session variable
$_SESSION["jours"] = $_POST['btn'];
$data = mysqli_query($mysqli,"SELECT id as id_user FROM vendeur WHERE username='".$_POST['btn']."'") or die(mysql_error());
$row = mysqli_fetch_assoc($data);
$id = $row['id_user'];
echo $id;
?>