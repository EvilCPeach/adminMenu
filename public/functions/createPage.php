<?php
    require_once '../config/link.php';
    $content = file_get_contents('../pages/maket.html');
    if(isset($_GET['namePage'],$_GET['linkPage']) && !empty($_GET['namePage']) && !empty($_GET['linkPage'])){
        $namePage = $_GET['namePage'];
        if(str_contains($_GET['linkPage'], '.')){
            $linkWords = trim(preg_replace( '/\s+/' , '' , $_GET['linkPage'] ));
            $linkPageReplace = preg_replace('/\.+/',' ', $_GET['linkPage']);
            $linkPageExplode = explode(' ', $linkPageReplace);
            $linkPage = array_slice($linkPageExplode, array_search(' ', $linkPageExplode), -1);
            $result = strtolower(implode('_',$linkPage));
            $linkPage = $result . '.php';
            header('location: ../pages/adminPanel.php');
        }
        else{
            $linkPage = str_replace(' ', '_', trim(strtolower($_GET['linkPage'] . '.php')));
            header('location: ../pages/adminPanel.php');
        }
        if(file_exists('../pages/' . $linkPage)){
            unlink('../pages' . $linkPage . '.php');
            header('location: ../pages/adminPanel.php');
        }
        else{
            file_put_contents('../pages/' . $linkPage,$content);
            $addQuery = "INSERT INTO `pages`(`name-page`, `link-page`) VALUES ('$namePage','$linkPage')";
            $resultAdd = $link->query($addQuery);
            header('location: ../pages/adminPanel.php');
        }
    }
    else{
        echo 'данные не пришли :(';
    }
?>