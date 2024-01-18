<?php
include 'content/header.php';
?>
<main>
    <?php
    if (isset($_POST['name']) & isset($_POST['login']) & isset($_POST['password'])) {
        echo '<section class="notif"><p><h2>';
        include 'DBConnect.php';
        if ($mysql != null) {
            $result = mysqli_query($mysql, "INSERT INTO person(login, password, name) VALUES ('".$_POST['login']."','".$_POST['password']."','".$_POST['name']."')");
            echo "Регистрация прошла успешно!";
        } else {

            echo "Данные неверны";
        }
        echo '
        </h2></p>
        <p><a href="index.php">На главную</a></p></section>';
    } else {
        echo '
            <form class = "center" action="reg.php" method="post">
            <p class="to-center"><h3>Форма регистрации</h3></p>
            <div class="to-center">
                <p><input type="name" name="name" placeholder="Имя"></p>
                <p><input type="name" name="login" placeholder="Логин"></p>
                <p><input type="password" name="password" placeholder="Пароль"></p>
                <p><label for="ok">Запомнить меня</label><input type="checkbox" name="ok"></p>
                <p><input type="submit" class="button" value="Регистрация"></p>
            </div>
            </form>';
    }
    ?>
    <script>
        localStorage.clear
    </script>
</main>
<?php
include 'content/footer.php';
?>