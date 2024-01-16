<?php
include 'Web-map-project/dbConnect.php';

$query = "SELECT JSON_OBJECT('id', global_id, 'title', full_name, 'x', latitude, 'y', longitude) as json_object FROM childmed";

$result = mysqli_query($mysql, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    $content = "ОШИБКА В ФАЙЛЕ getMapObjects";
} else {
    $content = array();
    while ($page = mysqli_fetch_assoc($result)) {
        $json_object = json_decode($page['json_object']);
        array_push($content, $json_object);
    }
    echo json_encode($content);
}
?>