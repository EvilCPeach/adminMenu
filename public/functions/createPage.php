<?php
    require_once '../config/link.php';
    $content = file_get_contents('../pages/maket.html');
    if(isset($_GET['namePage'],$_GET['linkPage']) && !empty($_GET['namePage']) && !empty($_GET['linkPage'])){
        $namePage = $_GET['namePage'];
        if(str_contains($_GET['linkPage'], '.php')){
            $linkPage = $_GET['linkPage'];
            header('location: ../pages/adminPage.php');
        }
        else{
            $linkPage = $_GET['linkPage'] . '.php';
            header('location: ../pages/adminPage.php');
        }
        if(file_exists('../pages/' . $linkPage)){
            unlink('../pages' . $linkPage);
            header('location: ../pages/adminPage.php');
            echo 'Существует';
        }
        else{
            file_put_contents('../pages/' . $linkPage,$content);
            $addQuery = "INSERT INTO `pages`(`name-page`, `link-page`) VALUES ('$namePage','$linkPage')";
            $resultAdd = $link->query($addQuery);
            header('location: ../pages/adminPage.php');
        }
    }
    else{

    }
?>