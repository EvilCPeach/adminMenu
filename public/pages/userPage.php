<?php
    session_start();
    if($_SESSION['role'] != 'user'){
        header('location: ../index.php');
        session_destroy();
    }
    else{
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>