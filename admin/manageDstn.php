<?php

if (!session_id())
    session_start();
include_once __DIR__ . "/../database/database.php";
include_once __DIR__ . "/../middleware/middleware.php";
isAdmin();
isLoggedIn();

$query = "SELECT des_id,name,banner FROM destinations GROUP BY des_id ORDER BY des_id DESC";
$stmt = $dbs->prepare($query);
$stmt->execute();
$data = $stmt->get_result();
$destination = $data->fetch_array(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/../template/meta.php"; ?>
    <title>Document</title>
</head>
<body>

<div class="container">

    <?php foreach ($destinations as $data): ?>
        <img src="<?= $data["banner"] ?>" alt="foto destination">
        <?= $data["name"] ?>
        <a href="/admin/editDstn.php?id=<?= $data["des_id"] ?>">/</a>
        <form action="" method="post">
            <input type="hidden" name="des_id" value="<?= $data["des_id"] ?>">
            <button type="submit" name="delete">X</button>
        </form>

    <?php endforeach; ?>

</div>


<div>
    <a href="/admin/createDstn.php">Add post</a>
</div>

</body>
</html>