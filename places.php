<?php

if(!session_id()) session_start();
include_once __DIR__ ."/database/database.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/template/meta.php";?>
    <title>Document</title>
</head>
<body>
    <?php include_once __DIR__ . "/template/navbar.php";?>

    

    <?php include_once __DIR__ . "/template/footer.php";?>

</body>
</html>