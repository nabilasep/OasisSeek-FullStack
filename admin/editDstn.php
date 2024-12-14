<?php
if (!session_id())
    session_start();
include_once __DIR__ . "/../database/database.php";
include_once __DIR__ . "/../middleware/middleware.php";
isAdmin();
isLoggedIn();

$des_id = $_GET['id'] ?? 0;

if (!isset($des_id) or $des_id <= 0) {
    header('Location: /admin/manageDstn.php');
    exit();
}

$query = "SELECT des_id, name, title, description FROM destinations WHERE des_id = ?";
$stmt = $dbs->prepare($query);
$stmt->bind_param("i", $des_id);
$stmt->execute();
$data = $stmt->get_result();
$destination = $data->fetch_array(MYSQLI_ASSOC);
$stmt->close();

if (isset($_POST["create"])) {
    $name = $_POST["name"] ?? "";
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";

    $query = "INSERT INTO destinations (name, title, description) VALUES (?, ?, ?)";
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("sss", $name, $title, $description);
    $stmt->execute();
    $des_id = $dbs->insert_id;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/../template/meta.php"; ?>
    <title>Create Destination</title>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?= $destination["name"] ?>" required>
        </div>
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= $destination["title"] ?>"required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" value="<?= $destination["description"] ?>" required></textarea>
        </div>
        <div>
            <input type="submit" name="update" value="update">
        </div>
    </form>

</body>

</html>