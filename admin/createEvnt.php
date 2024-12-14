<?php

if (!session_id())
session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ ."/../middleware/middleware.php";
isLoggedIn();
isAdmin();


if(isset($_POST["create"])){
    $name = $_POST["name"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $banner = "";

    $pathdir = "/../images/events";

    if(isset($_FILES["banner"]) && $_FILES["banner"]["error"] === UPLOAD_ERR_OK){
        $photo_tmp_path = $_FILES['banner']['tmp_name'];
        $photo_extension = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $photo_filename = uniqid() .'.'. $photo_extension;
        $photo_path = $pathdir . $photo_filename;

        if(move_uploaded_file($photo_tmp_path, $photo_path)){
            $banner =  $photo_filename;
        }else {
            echo'<script>alert("Error Uploading banner photo");
            location.replace("/admin/createEvnt.php");
            </script>';

        }
    }

    $query = "INSERT INTO events (name,title,description,location,date,time,banner) VALUES (?,?,?,?,?,?,?)";
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("sssssss", $name, $title, $description, $location, $date, $time, $baner);
    $stmt->execute();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/../template/meta.php"; ?>
    <title>Create Event - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="/../css/styles.css" />
</head>
<body>
    
    <div class="form-container">
        <h1>Create Event</h1>
        <?php if ($message): ?>
            <p><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="banner">Banner:</label>
            <input type="file" id="banner" name="banner" accept="image/*" required>

            <button type="submit" name="create">Create Event</button>
        </form>
    </div>

    
</body>
</html>
