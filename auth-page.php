
   <?php
   include "content/header.php";
    if (isset($_POST['login']) & isset($_POST['password'])) {
        echo '<section class="notif"><h2>';
        include 'dbConnect.php';
        if ($mysql != null) {
            $result = mysqli_query($mysql, "SELECT id,login FROM users WHERE login='" . $_POST['login'] . "' AND password='" . $_POST['password'] . "'");
            $name = mysqli_fetch_assoc($result);
            if ($name != null) {
                if ($_POST['login'] == $name['login']) {
                    
                    echo "Авторизация прошла успешно. Здравствуйте!";
                    $isauth = $name['id'];
                    echo ($isauth);
                    $_SESSION['auth'] = $isauth;
                }
            }else{
                echo "Данные для авторизации некорректны";
            }
        } else {

            echo "Данные неверны";
        }
        echo '
        </h2>
        <p><a href="index.php">На главную</a></p></section>';
    } else {
        echo '
        <form class="form-group text-center mt-4" action="auth-page.php" method="post">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="text-center"><h3>Форма авторизации</h3></div>
              <div class="row col-12 p-3">
                <input class="form-control mt-2 text-center" type="name" name="login" placeholder="Логин">
                <input class="form-control mt-2 text-center" type="password" name="password" placeholder="Пароль">
                <input class="btn btn-success mt-2 text-center" type="submit" value="Авторизация">
              </div>
            </div>
          </div>
        </div>
      </form>';
    }
    include "content/footer.php";
    ?>
<script>localStorage.clear</script>
