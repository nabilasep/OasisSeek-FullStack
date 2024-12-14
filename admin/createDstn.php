<?php
if (!session_id()) session_start();
include_once __DIR__ . "/../database/database.php";
include_once __DIR__ . "/../middleware/middleware.php";
isAdmin();
isLoggedIn();

if (isset($_POST["create"])) {
    $name = $_POST["name"] ?? "";
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";
    $gallery = $_FILES["gallery"] ?? [];
    $banner = "";

    $pathdir = "/../images/destinations/";

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $photo_tmp_path = $_FILES['banner']['tmp_name'];
        $photo_extension = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $photo_filename = uniqid() . '.' . $photo_extension;
        $photo_path = $pathdir . $photo_filename;

        if (move_uploaded_file($photo_tmp_path, $photo_path)) {
            $banner = $photo_filename;
        } else {
            echo "<script>
                    alert('Error uploading banner photo');
                    location.replace('/admin/createDstn.php');
                    </script>";
        }
    }

    $query = "INSERT INTO destinations (name, title, description, banner) VALUES (?, ?, ?, ?)";
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("ssss", $name, $title, $description, $banner);
    $stmt->execute();
    $des_id = $dbs->insert_id;

    if (!empty($gallery["tmp_name"])) {
        foreach ($gallery["tmp_name"] as $index => $tmp_name) {
            $extension = pathinfo($gallery["name"][$index], PATHINFO_EXTENSION);
            $img_name = uniqid() . "." . $extension;

            if (move_uploaded_file($tmp_name, $pathdir . $img_name)) {
                $query = "INSERT INTO img_destinations (des_id, photo) VALUES (?, ?)";
                $stmt = $dbs->prepare($query);
                $stmt->bind_param("ss", $des_id, $img_name);
                $stmt->execute();
            } else {
                echo "<script>
                    alert('Error uploading gallery photo');
                    location.replace('/admin/createDstn.php');
                    </script>";
            }
        }
    }
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
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="banner">Banner:</label>
        <input type="file" name="banner" id="banner" required>
    </div>
    <div>
        <label for="gallery">Gallery:</label>
        <input type="file" name="gallery[]" id="gallery" multiple>
    </div>
    <div>
        <input type="submit" name="create" value="Create">
    </div>
</form>

</body>
</html>