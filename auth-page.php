
   <?php
   include "content/header.php";
    if (isset($_POST['login']) & isset($_POST['password'])) {
        echo '<section  class="notif p-3"><div><a id="as" class ="p-1  mt-3 mb-1" href="index.php">На главную</a></div><h2>';
        include 'dbConnect.php';
        if ($mysql != null) {
            $result = mysqli_query($mysql, "SELECT id,login FROM users WHERE login='" . $_POST['login'] . "' AND password='" . $_POST['password'] . "'");
            $name = mysqli_fetch_assoc($result);
            if ($name != null) {
                if ($_POST['login'] == $name['login']) {
                    
                    echo "<div class='container text-center'><div class='col-12 text-center mt-3'>Авторизация прошла успешно. Добро пожаловать на сайт!</div><img id='pic' class='col-12  m-a mb-1' src='content/static/imgs/s-auth.svg'></div>";
                    $isauth = $name['id'];
                    // echo ($isauth);
                    $_SESSION['auth'] = $isauth;
                }
            }else{
                echo "<div class='container text-center'><div class='text-center mt-4'>Данные для авторизации некорректны</div><img id='pic' class=' col-12  m-a mb-1' src='content/static/imgs/f-auth.svg'></div>";
            }
        } else {

            echo "<div class='text-center'>Данные неверны</div>";
        }
        echo '
        </h2></section>
        ';
    } else {
        echo '
        <form class="form-group text-center mt-4" action="auth-page.php" method="post">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="text-center mt-4"><h3>Форма авторизации</h3></div>
              <div class="row col-12 p-3 mt-4">
                <input class="form-control mt-2 text-center" type="name" name="login" placeholder="Логин">
                <input class="form-control mt-2 text-center" type="password" name="password" placeholder="Пароль">
                <input id="as" class="btn btn-success mt-2 text-center" type="submit" value="Авторизация">
              </div>
            </div>
          </div>
        </div>
      </form>';
    }
    include "content/footer.php";
    ?>
<script>localStorage.clear</script>
