<?php
define('DB_HOST', 'localhost'); //Адрес
define('DB_USER', 'root'); //Имя пользователя
define('DB_PASSWORD', 'root'); //Пароль
define('DB_NAME', 'course_project'); //Имя БД
$mysql = null;
try {
    $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //echo('#SUCSESS#');
} catch (Exception $e) {
    echo '<h1>Ошибка подключения к серверу</h1>';
}
?>