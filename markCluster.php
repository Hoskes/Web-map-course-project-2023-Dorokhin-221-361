<?php
include 'dbConnect.php';
if(isset($_GET['cluster_id'])&&isset($_GET['id'])){
    echo $_GET['cluster_id'];
    echo $_GET['id'];
    $query = "UPDATE results SET alias='".$_GET['cluster_id']."' WHERE cluster_id=".$_GET['id'];
    $result = mysqli_query($mysql, $query);
    
    // $stmt = $mysql->prepare($query);
    // $stmt->bind_param("ss", $_GET['id'], $_GET['cluster_id']);
    // $stmt->execute();
}else{
    echo "err";
}

?>