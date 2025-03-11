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
            // $linkPage = strtolower($linkPageExplode);
            // print_r($linkPageReplace);
            // print_r($linkPageExplode);
            // $result = implode(' ', $link);
            print_r($linkPage);
            // print_r($result);
            $camelKase = array_map('unfirst', $linkPage);
            print_r($camelKase);
            // header('location: ../pages/adminPanel.php');
        }
        // else{
        //     $linkPage = $_GET['linkPage'] . '.php';
        //     header('location: ../pages/adminPanel.php');
        //     echo $linkPage;
        // }
        // if(file_exists('../pages/' . $linkPage)){
        //     unlink('../pages' . $linkPage);
        //     header('location: ../pages/adminPanel.php');
        //     echo 'Существует';
        //     echo $linkPage;
        // }
        // else{
        //     file_put_contents('../pages/' . $linkPage,$content);
        //     $addQuery = "INSERT INTO `pages`(`name-page`, `link-page`) VALUES ('$namePage','$linkPage')";
        //     $resultAdd = $link->query($addQuery);
        //     header('location: ../pages/adminPanel.php');
        // }
    }
    else{
        echo 'данные не пришли :(';
    }
?>