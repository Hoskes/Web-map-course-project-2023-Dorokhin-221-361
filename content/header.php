<!DOCTYPE html>
<?php
$title = "СоциальнаяСреда.рф Дорохин Андрей 221-361";
$title = "СоциальнаяСреда.рф Дорохин Андрей 221-361";
$n_link = array("Главная", "Форум", "Карта","Сменить кластер","Регистрация", "Авторизация");
$link = array("index.php", "forum-page.php","map.php","changeCluster.php","buy-page.php", "auth-page.php");
?>

<head>
    <title><?php echo $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link href="content/main-style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- <script src="sendDataToThePage.js"></script> -->
</head>
<script>
    function deleteAllCookies() {
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;";
            document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
        location.reload();
    }
</script>

<body id = 'bodystyle'>
    <header id='headerstyle' class='navbar navbar-expand-sm navbar-dark sticky-top d-flex justify-content-between p-4'>
        <div class="logo"><img id="logo-png" src="content/static/imgs/logo.png"></div>
        <div id='title'><?php echo $title ?></div>
        <div class="to-bottom">
            <nav class="d-flex justify-content-between">
                <?php
                session_start();
                if (!isset($_SESSION['autho'])) {
                    $_SESSION['autho'] = 0;
                    $_SESSION['first_visit'] = "11";
                    $is = 0;
                } else {
                    $is = $_SESSION['autho'];
                }
                for ($i = 0; $i < count($link)-2; $i++) {


                    if ($n_link[$i] != "Обратная связь" ) {
                        echo "<a id='ad' class='ms-4 p-1' href=$link[$i]>$n_link[$i]</a>";
                    } else {
                        if ($is != "0") {
                            
                                echo "<a class='ms-4 p-1' href=$link[$i]>$n_link[$i]</a>";
        
                        } else {
                        }
                    }
                }
                if (isset($_SESSION['auth']) && $_SESSION['auth'] != 0) {
                    echo '<input id="exit" class= "btn btn-sucsess ms-4" type="button" onClick="deleteAllCookies()" value="Выйти"/>';
                }else{
                    echo "<a id='ad' class='ms-4 p-1' href=$link[$i]>$n_link[$i]</a>";
                    $i+=1;
                    echo "<a id='ad' class='ms-4 p-1' href=$link[$i]>$n_link[$i]</a>";
                }
                ?>
            </nav>
        </div>
    </header>
    <main id ="page" class='card ms-5 me-5 mt-3 p-2'>