
<?php


// echo($_POST['json']);

// echo($_POST['json']);
include 'dbConnect.php';

//написать переключатель
if(isset($_POST['dataset'])& $_POST['dataset']==62541){
$query = "CALL insertSchools(?,?)";
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss",  $_POST['json'], $_POST['counter']);
echo($_POST['json']);
echo($_POST['counter']);
$stmt->execute();
}
if(isset($_POST['dataset'])& $_POST['dataset']==505){
$query = "CALL insertChildMed(?,?)";
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss",  $_POST['json'], $_POST['counter']);
echo($_POST['json']);
echo($_POST['counter']);
$stmt->execute();
}
if(isset($_POST['dataset'])& $_POST['dataset']==611){
$query = "CALL insertMFC(?,?)";
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss",  $_POST['json'], $_POST['counter']);
$stmt->execute();
echo($_POST['json']);
echo($_POST['counter']);
}

?>