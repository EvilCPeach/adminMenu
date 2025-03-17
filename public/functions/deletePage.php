<?php
    require_once '../config/link.php';
    $id = $_GET['id'];
    $name = $_GET['name'];
    $deleteQuery = " DELETE FROM `pages` WHERE `id-page` = '$id' ";
    $resultDelete = $link->query($deleteQuery);
    unlink('../pages/' . $name);
    header('location: ../pages/adminPanel.php');
?>
