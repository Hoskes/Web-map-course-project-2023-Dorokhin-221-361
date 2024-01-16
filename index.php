<?php
include 'content/header.php';
echo ($_SESSION['auth']);
if(!isset($_SESSION['auth'])||$_SESSION['auth']==''){
    include 'auth-page.php';
}
else {
    echo "<h1>ЭТО ГЛАВНАЯ СТРАНИЦА ГДЕ БУДУТ РАСПОЛОЖЕНЫ ОБЪЯВЛЕНИЯ ИЛИ КАРТА</h1>";
}



include 'content/footer.php';
?>
<!-- <iframe src='https://edadeal.ru/'></iframe> -->