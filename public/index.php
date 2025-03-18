<?php
  session_start();
  require_once 'config/link.php';
  $getPages = "SELECT * FROM `pages`";
  $resultPages = $link->query($getPages);
  $row = $resultPages->fetch_all(MYSQLI_ASSOC);
  if(isset($_POST['login'], $_POST['password']) && !empty($_POST)){
    if($_POST['password'] == 'admin' && $_POST['login'] == 'admin'){
      $_SESSION['role'] = 'admin';
      header('location: pages/adminPage.php');
    }
    else if($_POST['password'] == 'user' && $_POST['login'] == 'user'){
      $_SESSION['role'] = 'user';
      header('location: pages/userPage.php');
    }
    else{
      $_SESSION['role'] = 'unknown';
      header('location: /');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
        <li class="nav-item">
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Авторизоваться
          </button>
        </li>
        

        <!-- Модальное окно -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Заголовок модального окна</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <input type="text" name="login" class="form-control" placeholder="Введите логин">
                  <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                  <input type="submit" class="btn btn-primary" value="Войти">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>

        </li>
          <?php 
            foreach($row as $page){
          ?>
          <li class="nav-item">
            <a href="/pages/<?= $page['link-page'] ?>" class="nav-link"><?= $page['name-page'] ?></a>
          </li>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<footer class="fixed-bottom py-3 my-4">
  <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
  </ul>
  <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>