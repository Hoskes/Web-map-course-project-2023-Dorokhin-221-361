<?php
include 'content/header.php';
?>

    <?php
    if (isset($_POST['email']) & isset($_POST['first']) & isset($_POST['first']) & isset($_POST['login']) & isset($_POST['password'])) {
        if ($_POST['login'] != '' && $_POST['password'] != '' && $_POST['first'] != '' && $_POST['last'] != '' && $_POST['email'] != '') {
            echo '<section class=" align-items-center mt-4"><h2>';
            include 'dbConnect.php';
            $result = mysqli_query($mysql, "CALL createUser('" . $_POST['login'] . "','" . $_POST['password'] . "','" . $_POST['first'] . "','" . $_POST['last'] . "','" . $_POST['email'] . "')");
            echo "Регистрация прошла успешно!";
        } else {
            echo '
        </h2>
        <div class="text-center mt-4"><h3 mt-4>Данные регистрации некорректны!</h3></div>
        <a id="as" class="col-12 text-center mt-4 " href="reg.php">Вернуться к регистрации</a></section>';
        }
    } else {
        echo '
            <form class="form-group text-center mt-4" action="reg.php" method="post">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="text-center mt-4"><h3>Форма регистрации</h3></div>
              <div class="row col-12 p-3 mt-4">
                <input class="form-control mt-2 text-center" type="name" name="first" placeholder="Имя">
                <input class="form-control mt-2 text-center" type="name" name="last" placeholder="Фамилия">
                <input class="form-control mt-2 text-center" type="login" name="login" placeholder="Логин">
                <input class="form-control mt-2 text-center" type="password" name="password" placeholder="Пароль">
                <input class="form-control mt-2 text-center" type="email" name="email" placeholder="e-mail">
                <input class="btn btn-success mt-2 text-center" type="submit" value="Авторизация">
              </div>
            </div>
          </div>
        </div>
      </form>';
    }
    ?>
    <script>
        localStorage.clear
    </script>

<?php
include 'content/footer.php';
?>