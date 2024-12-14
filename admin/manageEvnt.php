<?php

if (!session_id())
session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ ."/../middleware/middleware.php";
isLoggedIn();
isAdmin();

$query = "SELECT event_id, name, date, banner FROM events GROUP BY event_id ORDER BY event_id DESC";
$stmt = $dbs->prepare(($query));
$stmt->execute();
$data = $stmt->get_result();
$event = $data->fetch_array(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/../template/meta.php";?>
    <title>Document</title>
</head>
<body>

    <div class="container">

        <?php foreach ($events as $data): ?>

        <img src="<?= $data["banner"]?>" alt="foto event">
        <?= $data["banner"] ?>
        <?= $data["name"] ?>
        <?= $data["date"] ?>

        <a href="/admin/editEvnt.php?id=<? $data["event_id"]?>"></a>
        <form action="" method="post">
            <input type="hidden" name="event_id" value="<? $data["event_id"]?>">
            <button type="submit" name="delete">X</button>
        </form>
        <?php endforeach; ?>

    </div>

    
    <div>
        <a href="/admin/createEvnt.php">Add Post</a>
    </div>

</body>
</html>