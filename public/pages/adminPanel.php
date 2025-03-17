<?php
  session_start();
  require_once '../config/link.php';
  $getPages = "SELECT * FROM `pages`";
  $resultPages = $link->query($getPages);
  $row = $resultPages->fetch_all(MYSQLI_ASSOC);
  if($_SESSION['role'] != 'admin'){
    header('location: ../index.php');
  }
  else{
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/adminPanelStyle.css">
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
          <a class="nav-link" aria-current="page" href="adminPage.php">Назад</a>
        </li>
          <?php 
            foreach($row as $page){
          ?>
          <li class="nav-item">
            <a href="<?= $page['link-page']; ?>" class="nav-link"><?= $page['name-page'] ?></a>
          </li>
          <?php }; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <section class="buttons d-flex justify-content-around align-items-center">
        <form action="../functions/createPage.php" method="GET" class="d-flex flex-column">
          <input type="text" name="namePage" class="form-control" placeholder="Введите название страницы">
          <input type="text" name="linkPage" class="form-control" placeholder="Введите ссылочное название">
          <input type="submit" class="btn btn-success" id="createButton" value="Создать страницу">
        </form>
        <article class="d-flex justify-content-center">
          <table>
            <thead>
              <th>Название</th>
              <th>Корневое название</th>
            </thead>
              <?php foreach($row as $page){ ?>
                <tr id="target" draggable="true">
                  <td><?= $page['name-page'] ?></td>
                  <td><?= $page['link-page'] ?></td>
                  <td>
                    <a href="../functions/deletePage.php?id=<?= $page['id-page'] ?>&name=<?= $page['link-page'] ?>">Удалить</a>
                  </td>
                  <td>
                    <a href="../functions/changePage.php?id=<?= $page['id-page'] ?>&name=<?= $page['link-page'] ?>">Изменить</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
        </article>
    </section>
    <footer class="fixed-bottom py-3">
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
<script src="../scripts/script.js"></script>
</body>
</html>