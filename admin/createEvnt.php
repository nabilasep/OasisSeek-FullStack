<?php

if (!session_id())
  session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ . "/../middleware/middleware.php";
isLoggedIn();
isAdmin();


if (isset($_POST["create"])) {
  $name = $_POST["name"];
  $title = $_POST["title"];
  $description = $_POST["description"];
  $location = $_POST["location"];
  $date = $_POST["date"];
  $time = $_POST["time"];
  $banner = "";

  $pathdir = "/../images/events";

  try {

    mysqli_begin_transaction($dbs);

    if (isset($_FILES["banner"]) && $_FILES["banner"]["error"] === UPLOAD_ERR_OK) {
      $photo_tmp_path = $_FILES['banner']['tmp_name'];
      $photo_extension = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
      $photo_filename = uniqid() . '.' . $photo_extension;
      $photo_path = __DIR__ . '/../images/events/' . $photo_filename; // Corrected path

      if (move_uploaded_file($photo_tmp_path, $photo_path)) {
        $banner = $photo_filename;
      } else {
        echo '<script>alert("Error Uploading banner photo"); location.replace("/admin/createEvnt.php"); </script>';
        exit();
      }
    }

    $query = "INSERT INTO events (name, title, description, location, date, time, banner) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbs->prepare($query);
    $stmt->bind_param("sssssss", $name, $title, $description, $location, $date, $time, $banner); // Fixed variable name
    $stmt->execute();
    mysqli_commit($dbs);

    echo "<script>
    alert('Event added successfully');
    location.replace('/admin/manageEvnt.php');
  </script>";

  } catch (Exception $err) {
    mysqli_rollback($dbs);
    echo "<script>alert('error $err')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once __DIR__ . "/../template/meta.php"; ?>
  <title>Create Event - OasisSeek</title>
  <link rel="stylesheet" type="text/css" href="../images/assets/styles.css" />
  <style>
    .form-container {
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
      color: rgba(0, 0, 0, 0.5);
      letter-spacing: 0.3px;
      padding: 9px 18px;
      font: 400 12px/2 'Poppins', sans-serif;
      border: 1px solid rgba(115, 76, 16, 1);
      width: 100%;
      height: 30px;
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
      color: rgba(0, 0, 0, 0.5);
      letter-spacing: 0.3px;
      padding: 9px 17px;
      min-height: 100px;
      font: 400 12px/2 Poppins, sans-serif;
      border: 1px solid rgba(115, 76, 16, 1);
      width: 100%;
      margin-bottom: 20px;
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


    .submit-button {
      border-radius: 5px;
      background-color: rgba(115, 76, 16, 1);
      align-self: end;
      display: flex;
      margin-top: 40px;
      min-height: 42px;
      align-items: center;
      gap: 5px;
      color: var(--white, #fff);
      text-align: center;
      justify-content: center;
      padding: 11px 20px;
      font: 13px 'Poppins', sans-serif;
      border: none;
      cursor: pointer;
      border-style: none;
    }

    .submit-icon {
      aspect-ratio: 1;
      object-fit: contain;
      width: 14px;
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
      .dashboard-container {
        padding: 0 20px;
      }

      .sidebar-container {
        margin-top: 40px;
      }

      .main-content {
        padding: 0 20px 100px;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .datetime-container {
        flex-direction: column;
        gap: 20px;
      }

    }
  </style>

</head>

<body>

  <!-- ======= MAIN DASHBOARD ========  -->
  <div class="main-dashboard">
    <div class="dashboard">
      <?php include_once __DIR__ . "/../template/navbarAdm.php"; ?>

      <!-- ===== Header =======  -->
      <header class="dashboard-header">
        <h1 class="page-title-dashboard">Add Event</h1>
        <div class="user-profile-dashboard">
          <img class="profile-icon-dashboard" src="../assets/profile-admin.png" alt="User profile" />
          <div class="profile-text-dashboard">Admin</div>
        </div>
      </header>

      <!-- ===== Konten Posts =======  -->
      <div class="dashboard-content">
        <form method="post" enctype="multipart/form-data">
          <div class="form-grid">

            <div class="form-container">
              <h1>Create Event</h1>

              <form method="post" enctype="multipart/form-data">
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
                <input type="file" id="banner" name="banner" required>

                <button type="submit" name="create">Create Event</button>
              </form>
            </div>

            <script>
              // preview thumbnile
              function updateThumbnailPreview(event) {
                const previewContainer = document.getElementById('thumbnail-preview');
                const files = event.target.files;

                // hapus previous content
                previewContainer.innerHTML = '';

                if (files && files[0]) {
                  const file = files[0];

                  // preview icon
                  const icon = document.createElement('img');
                  icon.src = '../assets/attach-icon.png'; // Replace with the attach icon URL
                  icon.alt = 'Attach Icon';
                  icon.className = 'preview-icon';

                  // tambah nama file
                  const fileName = document.createElement('span');
                  fileName.textContent = file.name;

                  // tambah ke container
                  previewContainer.appendChild(icon);
                  previewContainer.appendChild(fileName);
                }
              }
            </script>


</body>

</html>