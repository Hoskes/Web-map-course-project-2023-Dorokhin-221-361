
<?php

echo($_POST['json']);
echo($_POST['counter']);
// echo($_POST['json']);

// echo($_POST['json']);
include 'dbConnect.php';

//написать переключатель
$query = "CALL insertAdultMed(?,?)";
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss",  $_POST['json'], $_POST['counter']);
$stmt->execute();



?>