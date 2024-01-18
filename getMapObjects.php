<?php
include 'Web-map-project/dbConnect.php';

$query = "SELECT JSON_OBJECT('id', id, 'title', cluster_id,'full_name',full_name, 'x', x, 'y', y,'alias',alias) as json_object FROM (SELECT * FROM results r LEFT JOIN childmed c ON r.id=c.global_id ORDER BY cluster_id ASC) as e";

$result = mysqli_query($mysql, $query);
$content = array();
if (!$result || mysqli_num_rows($result) == 0) {
    $content = "ОШИБКА В ФАЙЛЕ getMapObjects";
} else {
    while ($page = mysqli_fetch_assoc($result)) {
        $json_object = json_decode($page['json_object']);
        array_push($content, $json_object);
    }
    $content2=$content;
    echo json_encode($content);
}
?>