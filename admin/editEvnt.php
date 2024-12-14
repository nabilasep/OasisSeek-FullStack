<?php 
if (!session_id())
session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ ."/../middleware/middleware.php";
isLoggedIn();
isAdmin();

$event_id = $_GET['id'] ?? 0;

if (!isset($event_id) or $evant_id <= 0) {
    header('Location: /admin/manageEvnt.php');
    exit();
}

$query = "SELECT event_id, name, title, description, location, date, time FROM events WHERE event_id = ?";
$stmt = $dbs->prepare($query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$data = $stmt->get_result();
$event = $data->fetch_array(MYSQLI_ASSOC);
$stmt->close();

if (isset($_POST["create"])) {
    $name = $_POST["name"] ?? "";
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";
    $location = $_POST["location"] ?? "";
    $date = $_POST["date"] ?? "";
    $time = $_POST["time"] ??"";

    $query = "INSERT INTO destinations (name, title, description, location, date, time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("ssssss", $name, $title, $description, $location, $date, $time);
    $stmt->execute();
    $event_id = $dbs->insert_id;

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
            <input type="text" name="name" id="name" value="<?= $event["name"] ?>" required>
        </div>
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= $event["title"] ?>"required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" value="<?= $event["description"] ?>" required></textarea>
        </div>
        <div>
            <label for="location">Location:</label>
            <textarea name="description" id="description" value="<?= $event["location"] ?>" required></textarea>
        </div>
        <div>
            <label for="date">Date:</label>
            <textarea name="description" id="description" value="<?= $event["date"] ?>" required></textarea>
        </div>
        <div>
            <label for="time">Time:</label>
            <textarea name="description" id="description" value="<?= $event["time"] ?>" required></textarea>
        </div>

        <div>
            <input type="submit" name="update" value="Update">
        </div>
    </form>

</body>

</html>