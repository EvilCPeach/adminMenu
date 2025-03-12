<?php
    require_once '../config/link.php';
    $id = $_GET['id'];
    $name = $_GET['name'];
    $getAllPages = "SELECT * FROM `pages`";
    $resultAllPages = $link->query($getAllPages);
    $rowAll = $resultAllPages->fetch_all(MYSQLI_ASSOC);
    $getPage = " SELECT * FROM `pages` WHERE `id-page` = '$id' ";
    $resultPage = $link->query($getPage);
    $row = $resultPage->fetch_all(MYSQLI_ASSOC);
    if(isset($_GET['newNamePage'],$_GET['newLinkPage']) && !empty($_GET['newNamePage']) && !empty($_GET['newLinkPage'])){
        $newLinkPage = $_GET['newLinkPage'];
        $newNamePage = $_GET['newNamePage'];
        if(str_contains($_GET['newLinkPage'], '.')){
            $linkWords = trim(preg_replace( '/\s+/' , '' , $_GET['newLinkPage'] ));
            $linkPageReplace = preg_replace('/\.+/',' ', $_GET['newLinkPage']);
            $linkPageExplode = explode(' ', $linkPageReplace);
            $linkPage = array_slice($linkPageExplode, array_search(' ', $linkPageExplode), -1);
            $result = strtolower(implode('_',$linkPage));
            $linkPage = $result . '.php';
            rename('../pages/' . $name, '../pages/' . $linkPage);
            $changeQuery = " UPDATE `pages` SET `name-page`='$newNamePage',`link-page`='$linkPage' WHERE `id-page` = '$id' ";
            $resultChange = $link->query($changeQuery);
            // header('location: ../pages/adminPanel.php');
        }
        else{
            $linkPage = str_replace(' ', '_', trim(strtolower($_GET['newLinkPage'] . '.php')));
            $changeQuery = " UPDATE `pages` SET `name-page`='$newNamePage',`link-page`='$linkPage' WHERE `id-page` = '$id' ";
            $resultChange = $link->query($changeQuery);
            rename("../pages/$name", "../pages/$linkPage");
            // header('location: ../pages/adminPanel.php');
        }
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
    <title>Document</title>
</head>
<body>
  <style>
    form{
      width: 300px;
      height: 200px;
    }
    input{
      margin: 0 0 10px 0;
    }
    section{
      width: 100%;
      height: 500px;
    }
    article{
      width: 50%;
      height: 100%;
    }
    table{
      width: 100%;
    }
  </style>
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
            foreach($rowAll as $pages){
          ?>
          <li class="nav-item">
            <a href="<?= $pages['link-page'] ?>" class="nav-link"><?= $pages['name-page'] ?></a>
          </li>
          <?php }; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <section class="buttons d-flex justify-content-around align-items-center">
        <form action="" method="GET" class="d-flex flex-column">
          <input type="text" name="id" class="form-control" value="<?= $_GET['id'] ?>" hidden>
            <input type="text" name="name" class="form-control" value="<?= $_GET['name'] ?>" hidden>
          <input type="text" name="newNamePage" class="form-control" placeholder="Введите новое название страницы">
          <input type="text" name="newLinkPage" class="form-control" placeholder="Введите новое ссылочное название">
          <input type="submit" class="btn btn-success" id="changeButton" value="Изменить страницу">
        </form>
        <article class="d-flex justify-content-center">
          <table>
            <thead>
              <th>Название</th>
              <th>Корневое название</th>
            </thead>
              <?php foreach($row as $page){ ?>
                <tr>
                  <td><?= $page['name-page'] ?></td>
                  <td><?= $page['link-page'] ?></td>
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
</body>
</html>