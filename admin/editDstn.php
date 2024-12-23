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



if (isset($_POST["update"])) {
    $name = $_POST["name"] ?? "";
    $title = $_POST["title"] ?? "";
    $description = $_POST["description"] ?? "";

    try {
    $query = "UPDATE destinations SET name = ?,  title = ?, description = ? WHERE des_id =?"; 
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("sssi", $name, $title, $description, $des_id);
    $stmt->execute();
    $des_id = $dbs->insert_id;

        // Success message or redirect
        echo "<script>
        alert('Places berhasil di update');
        location.replace('/admin/manageDstn.php');
        </script>";
        exit();
    } catch (Exception $e) {
        // Handle the error
        echo "<script>
        alert('Places gagal di update');
        location.replace('/admin/manageDstn.php');
        </script>";
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/../template/meta.php"; ?>
    <title>Create Destination</title>
    <link rel="stylesheet" href="../images/assets/styles.css">
    <style>
        .form-section {
            margin-top: 31px;
            width: 655px;
            max-width: 100%;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 6px;
            margin-bottom: 30px;
        }

        .form-label {
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 600;
            margin-top: 50px;
        }


        .form-input {
            border-radius: 5px;
            background-color: rgba(249, 250, 251, 1);
            padding: 11px 18px;
            border: 1px solid rgba(115, 76, 16, 1);
            font-size: 12px;
            font-weight: 300;
            width: 100%;
            margin-top: 5px;
        }


        .datetime-container {
            display: flex;
            gap: 30px;
            margin-top: 23px;
        }

        .date-input,
        .time-input {
            flex: 1;
        }



        .form-textarea {
            border-radius: 5px;
            background-color: rgba(249, 250, 251, 1);
            width: 100%;
            padding: 10px 18px 40px;
            border: 1px solid rgba(115, 76, 16, 1);
            font-size: 12px;
            font-weight: 300;
            resize: vertical;
            margin-bottom: 10px;
            margin-top: 5px;
        }

        .upload-container {
            border-radius: 5px;
            background-color: rgba(249, 250, 251, 1);
            display: flex;
            margin-top: 11px;
            flex-direction: column;
            align-items: center;
            color: rgba(115, 76, 16, 1);
            letter-spacing: 0.3px;
            justify-content: center;
            padding: 26px 80px;
            font: 400 12px/2 Poppins, sans-serif;
            border: 1px dashed rgba(115, 76, 16, 1);
        }

        #thumbnail-preview,
        #gallery-preview {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .file-preview {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #000;
        }

        .preview-icon {
            width: 20px;
            height: 20px;
        }

        .visually-hidden {
            display: none;
        }

        .upload-icon {
            width: 32px;
            height: 32px;
        }



        /* button save & cancel */
        .action-buttons {
            align-self: end;
            display: flex;
            margin-top: 34px;
            align-items: center;
            gap: 14px;
            font-size: 20px;
        }

        .btn-cancel {
            border-radius: 24px;
            color: var(--btn-daftar-masuk, #734c10);
            padding: 15px 25px;
            border: 1px solid rgba(115, 76, 16, 1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #ebdac8;
            border-color: #734c10;
            color: #734c10;
        }

        .btn-save {
            border-radius: 24px;
            background-color: rgba(115, 76, 16, 1);
            color: var(--Foundation-Yellow-Light, #f8f3ed);
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-save:hover {
            background-color: #ebdac8;
            border: 1px solid #734c10;
            color: #734c10;
        }


        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        @media (max-width: 991px) {

            .action-buttons {
                margin-right: 3px;
            }

            .btn-cancel,
            .btn-save {
                padding: 0 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container-dashboard">
        <?php include_once __DIR__ . "/../template/navbarAdm.php"; ?>

        <!-- ===== Konten Posts =======  -->
        <div class="dashboard-content">
            <div class="dashboard-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div> <label for="name">Name:</label> <input type="text" name="name" id="name"
                                value="<?= htmlspecialchars($destination["name"]) ?>" required> </div>
                        <div> <label for="title">Title:</label> <input type="text" name="title" id="title"
                                value="<?= htmlspecialchars($destination["title"]) ?>" required> </div>
                        <div> <label for="description">Description:</label> <textarea name="description"
                                id="description"
                                required><?= htmlspecialchars($destination["description"]) ?></textarea> </div>
                        <div> <label for="location">Location</label> <input type="text" name="location" id="location"
                                class="form-input" required> </div>
                        <div> <input type="submit" name="update" value="Update"> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>