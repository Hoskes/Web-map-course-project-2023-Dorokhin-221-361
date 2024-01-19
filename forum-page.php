<?php


include 'dbConnect.php';
include 'content/header.php';
echo '<div class="container">';

// $forum_id = $_GET['id'];
if (!isset($_GET['id']) || $_GET['id'] == '') {
    echo '<h2 class="text-center">Обсуждения</h2>';
    $query = "SELECT * FROM discusses ORDER BY date_changed desc;";
    $result = mysqli_query($mysql, $query);
    //echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) { //Если в БД есть данные об устройстве
        $content = '';
        while ($forum = mysqli_fetch_assoc($result)) {
            $descr = $forum['description'];
            if(strlen($descr)>200){
                $descr=substr($descr,0,400).' . . .';
            }
            $content.="<div class='card mt-4 p-2'>";
            $content .= "<br><h2 class='card-title'>" . $forum['title'] . "</h2><div>" . $descr . "</div class='mt-2 ms-2'></h2><div class='card-text'>" . $forum['description'] . "</div class='mt-2 ms-2 p-2'><br><div>Дата создания:" . $forum['date_created'] . "<br>Дата изменения: " . $forum['date_changed'] . "</div>";
            $content .= "<a id='btn-sumbit' class='btn btn-sucsess' href='forum-page.php?id=" . $forum['id'] . "'>Открыть</a>";
            $content .="</div>";
        }
        echo $content;
    } else {
        echo ('ПУСТОЙ ЗАПРОС ВОЗМОЖНО ОШИБКА');
    }
}else if(ctype_digit($_GET['id']))
{
    $forum_id = $_GET['id'];
    // echo($forum_id);
    $query = "SELECT * FROM discusses d LEFT JOIN course_project.messages m on d.id = m.discuss_id WHERE d.id =".$forum_id;
    $result = mysqli_query($mysql, $query);
    //echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) { //Если в БД есть данные об устройстве
        while ($forum = mysqli_fetch_assoc($result)) {
            $content = '';
            $content.="<div class='card mt-2 p-3'>";
            $content .= "<a id='ad' class='p-2' href='forum-page.php'>К форумам</a>";
            $content .= "<br><h2 class='card-title'>" . $forum['title'] . "</h2><div class='card-text'>" . $forum['description'] . "</div><br><div class='mt-2 ms-2 p-2'>Дата создания:" . $forum['date_created'] . "<br>Дата изменения: " . $forum['date_changed'] . "</div>";
            $content .="</div>";
        }
        echo $content;
        include 'try.php';
    } else {
        echo ('ПУСТОЙ ЗАПРОС ВОЗМОЖНО ОШИБКА');
    }

}
echo '</div>';
include 'content/footer.php';