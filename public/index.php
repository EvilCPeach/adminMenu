<?php
  session_start();
  require_once 'config/link.php';
  if(isset($_POST) && !empty($_POST)){
    if($_POST['password'] == 'admin'){
      $_SESSION['role'] = 'admin';
      header('location: pages/adminPage.php');
    }
    else if($_POST['password'] == 'user'){
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
  <title>Document</title>
</head>
<body>
<style>
    form{
      width: 250px;
      height: 200px;
    }
    input{
      margin: 0 0 10px 0;
    }
  </style>
  <section class="w-100 vh-100 d-flex justify-content-center align-items-center">
    <form action="" method="POST" class="d-flex flex-column">
      <input type="text" name="login" placeholder="Введите логин" class="form-control">
      <input type="password" name="password" placeholder="Введите пароль" class="form-control">
      <input type="submit" value="Войти">
    </form>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>