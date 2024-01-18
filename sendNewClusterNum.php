<?php 
// $forum_id = $_GET['forum_id'];
// session_start();
include 'Web-map-project/dbConnect.php';
echo($_GET['id']);
echo($_GET['cluster_id']);
// echo($_POST['json']);

// echo($_POST['json']);
include 'dbConnect.php';

//написать переключатель
$query = "UPDATE results SET cluster_id=? WHERE id=?";
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss", $_GET['cluster_id'], $_GET['id']);
$stmt->execute();


?>