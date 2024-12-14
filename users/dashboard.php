<?php
// php -S localhost:3000
if (!session_id())
    session_start();

require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../middleware/middleware.php";

// Middleware to check if user is logged in
isLoggedIn();
isUser();

$user = $_SESSION["user"] ?? [];
$username = $user['username'] ?? '';

// Fetch user bookmarks
$query_bookmarks = "SELECT destinations.banner, destinations.name, destinations.description 
                    FROM bookmark 
                    JOIN destinations ON bookmark.des_id = destinations.des_id 
                    WHERE bookmark.username = ?";
$stmt_bookmarks = $dbs->prepare($query_bookmarks);
if (!$stmt_bookmarks) {
    die("Prepare failed: " . $dbs->error);
}
$stmt_bookmarks->bind_param("s", $username);
$stmt_bookmarks->execute();
$data_bookmarks = $stmt_bookmarks->get_result();
$bookmarks = $data_bookmarks->fetch_all(MYSQLI_ASSOC);
$stmt_bookmarks->close();

// Function to generate unique filename
function generateUniqueFilename($path, $extension)
{
    $filename = uniqid() . "." . $extension;
    while (file_exists($path . $filename)) {
        $filename = uniqid() . "." . $extension;
    }
    return $filename;
}

// Handle profile update and photo upload
if (isset($_POST["Save"])) {
    $new_username = $_POST['username'];
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_photo = $user['photo'];

    // Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        if (!empty($user["photo"]) && file_exists(__DIR__ . "/.." . $user["photo"])) {
            unlink(__DIR__ . "/.." . $user["photo"]);
        }

        $photo_tmp_path = $_FILES['photo']['tmp_name'];
        $photo_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo_dir = __DIR__ . "/../images/profiles/";
        $photo_filename = generateUniqueFilename($photo_dir, $photo_extension);
        $photo_dest_path = $photo_dir . $photo_filename;

        // Move uploaded file to the destination directory
        if (move_uploaded_file($photo_tmp_path, $photo_dest_path)) {
            $new_photo = "/images/profiles/" . $photo_filename;
        } else {
            echo "<script>alert('Error uploading photo.')</script>";
        }
    }

    $update_query = "UPDATE users SET username = ?, name = ?, email = ?, photo = ? WHERE username = ?";
    $stmt_update = $dbs->prepare($update_query);
    $stmt_update->bind_param("sssss", $new_username, $new_name, $new_email, $new_photo, $username);
    $stmt_update->execute();
    $stmt_update->close();

    // Update session data
    $user["username"] = $new_username;
    $user["name"] = $new_name;
    $user["email"] = $new_email;
    $user["photo"] = $new_photo;
    $_SESSION["user"] = $user;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Profile - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="dashboard">
        <!-- ======== HEADER ======== -->
        <div class="landing-container">
            <?php include_once __DIR__ . "/../template/navbar.php"; ?>
        </div>

        <!-- ======== FORM UBAH PROFILE ======== -->
        <main class="main-content-profile">
            <section class="profile-section" aria-labelledby="profile-title">
                <h1 id="profile-title" class="profilesection-title">My Profile</h1>
                <p class="profilesection-subtitle">Manage your account profile</p>

                <div class="profile-grid">
                    <form class="profile-form" aria-label="Profile information form" method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group-profile">
                            <label for="username" class="form-label-profile">Username</label>
                            <input type="text" id="username" name="username" class="form-input-profile"
                                value="<?= htmlspecialchars($user['username']); ?>" required />
                        </div>
                        <div class="form-group-profile">
                            <label for="name" class="form-label-profile">Name</label>
                            <input type="text" id="name" name="name" class="form-input-profile"
                                value="<?= htmlspecialchars($user['name']); ?>" required />
                        </div>
                        <div class="form-group-profile">
                            <label for="email" class="form-label-profile">Email</label>
                            <input type="email" id="email" name="email" class="form-input-profile"
                                value="<?= htmlspecialchars($user['email']); ?>" required />
                        </div>
                        <div class="form-actions-profile">
                            <input type="submit" name="Save" class="btn-primary-profile" value="Save" />
                            <a href="/logout.php">Log Out</a>
                        </div>

                        <!-- ======== UPLOAD FOTO PROFILE ======== -->
                        <div class="profile-picture-section">
                            <img src="<?= htmlspecialchars($user['photo'] ?? 'https://cdn.builder.io/api/v1/image/assets/TEMP/71a2fb7aa070218e7a9b043b4c0095d72c1d71e5603b41db3ab9f4a92d041727?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d'); ?>"
                                alt="User profile picture" class="current-profile-picture">
                            <div class="picture-upload">
                                <input type="file" id="file-input" name="photo" class="file-input" accept=".jpeg, .png"
                                    hidden />
                                <button type="button" class="upload-btn-profile"
                                    onclick="document.getElementById('file-input').click()">Select picture</button>
                                <p class="upload-info-profile">Max file size: 5 MB</p>
                                <p class="upload-info-profile">Format: .JPEG, .PNG</p>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- ======== BOOKMARKS ======== -->
                <section class="bookmarks-section" aria-labelledby="bookmarks-title">
                    <h2 id="bookmarks-title" class="profilesection-title">Bookmarks</h2>
                    <p class="profilesection-subtitle">Mark your journey through Egypt's treasures!</p>

                    <div class="bookmarks-list">
                        <?php foreach ($bookmarks as $bookmark): ?>
                            <article class="bookmark-card">
                                <img src="/images/destinations/<?= htmlspecialchars($bookmark['banner']); ?>"
                                    alt="<?= htmlspecialchars($bookmark['name']); ?>" class="bookmark-image" />
                                <div class="bookmark-content">
                                    <h3 class="bookmark-title"><?= htmlspecialchars($bookmark['name']); ?></h3>
                                    <p class="bookmark-description"><?= htmlspecialchars($bookmark['description']); ?></p>
                                </div>
                                <button type="button" class="bookmark-action" aria-label="Remove bookmark">
                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae785c420c97267ac981f08c07dc55b5e385399d76b7d52d4adf6024d5f0ea12?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                                        alt="" class="action-icon" />
                                </button>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>

            </section>
        </main>

        <!-- =========== FOOTER =========== -->
        <?php include_once __DIR__ . "/../template/footer.php"; ?>
    </div>

    <!-- =============== KODE JAVASCRIPT ================= -->
    <script>
        // UPLOAD FOTO
        const fileInput = document.getElementById('file-input');
        const currentProfilePicture = document.querySelector('.current-profile-picture');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if (file && file.size <= 5 * 1024 * 1024) { // Maksimum ukuran 5 MB
                const reader = new FileReader();

                reader.onload = (e) => {
                    currentProfilePicture.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please select an image smaller than 5 MB.');
            }
        });
    </script>

</body>

</html>