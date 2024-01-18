<?php
$forum_id = $_GET['f_id'];
// echo $forum_id;
if (isset($_GET['limit_msg'])) {
    $limit_msg += $_GET['limit_msg'];
} else {
    $limit_msg = 10;
}
include 'Web-map-project/dbConnect.php';
$query = "SELECT * FROM discusses d JOIN course_project.messages m on d.id = m.discuss_id JOIN (SELECT user_id,first_name,last_name FROM user_details) as ud ON ud.user_id=m.author_id WHERE d.id =" . $forum_id . " ORDER BY m.date_created DESC LIMIT ".$limit_msg;
$result = mysqli_query($mysql, $query);
echo "В обсуждении " . mysqli_num_rows($result) . " сообщений";
if (mysqli_num_rows($result) > 0) { //Если в БД есть данные об устройстве
    $content = '';
    echo '<div class="container col-12 align-items-center p-auto">';
    while ($forum = mysqli_fetch_assoc($result)) {

        $content .= "<br>" . "<div id='text' class='col-12 p-1 rounded-3'>";
        $content .= "<p id='text-i' class=' mt=2 mb-0'>" . $forum["first_name"] . " " . $forum["last_name"] . " " . $forum['date_created']."</p>";
        $content .= '<div >'.$forum['msg_text'].'</div>' ;
        $content .= "</div>";
    }
    echo $content;
    echo "</div>";
} else {
    echo ('');
}
?>