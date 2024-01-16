<?php 
$forum_id = $_GET['forum_id'];
session_start();
include 'Web-map-project/dbConnect.php';
if (isset($_POST['comment'])) {
    $date_today = date("Y-m-d H:i:s");
    $comment = $_POST['comment'];
    echo $_POST['comment'];
    // echo $_POST['button_on'];
    $query = "INSERT INTO messages(discuss_id, msg_text, date_created,author_id) VALUES (".$forum_id.",?,?,?)";
    // $result = mysqli_query($mysql, $query);
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("sss", $comment , $date_today,$_SESSION['auth']);
    $stmt->execute();
    $result = mysqli_stmt_get_result($stmt);
}else{
    echo('1');
}

?>