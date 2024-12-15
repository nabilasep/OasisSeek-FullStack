<?php
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

$username = $_SESSION['user']['username'] ?? '';

// Check if des_id or id is set
$des_id = isset($_GET['des_id']) ? $_GET['des_id'] : (isset($_GET['id']) ? $_GET['id'] : null);

if ($des_id === null) {
    header('Location: /destinations.php');
    exit();
}

// Handle bookmark actions
if (isset($_POST['bookmark_action'])) {
    $action = $_POST['bookmark_action'];

    if ($action == 'add') {
        $bookmark_query = "INSERT INTO bookmark (des_id, username) VALUES (?, ?)";
        $stmt = $dbs->prepare($bookmark_query);
        $stmt->bind_param('is', $des_id, $username);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'remove') {
        $bookmark_query = "DELETE FROM bookmark WHERE des_id = ? AND username = ?";
        $stmt = $dbs->prepare($bookmark_query);
        $stmt->bind_param('is', $des_id, $username);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch destination details
$query = "SELECT des_id, name, title, description, banner FROM destinations WHERE des_id = ?";
$stmt = $dbs->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $dbs->error);
}
$stmt->bind_param("i", $des_id);
$stmt->execute();
$data = $stmt->get_result();
$destination = $data->fetch_assoc();
$stmt->close();

if (!$destination) {
    header("Location: /destinations.php");
    exit();
}

// Fetch images related to the destination
$query_images = "SELECT photo FROM img_destinations WHERE des_id = ?";
$stmt_images = $dbs->prepare($query_images);
if (!$stmt_images) {
    die("Prepare failed: " . $dbs->error);
}
$stmt_images->bind_param("i", $des_id);
$stmt_images->execute();
$data_images = $stmt_images->get_result();
$images = $data_images->fetch_all(MYSQLI_ASSOC);
$stmt_images->close();

// Check if the destination is bookmarked
$bookmark_check_query = "SELECT 1 FROM bookmark WHERE des_id = ? AND username = ?";
$stmt_check = $dbs->prepare($bookmark_check_query);
$stmt_check->bind_param('is', $des_id, $username);
$stmt_check->execute();
$is_bookmarked = $stmt_check->get_result()->num_rows > 0;
$stmt_check->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Places Each - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="/images/assets/styles.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="placeseach-wrapper">
    <!-- ======== HEADER ======== -->
    <div class="landing-container">
        
    <?php include_once __DIR__ . "/template/navbar.php";?>

        <!-- ======== HERO SECTION ======== -->
        <section class="hero-section-placeseach">
            <img src="/images/destinations/<?= htmlspecialchars($destination['banner']); ?>" alt="Scenic view of <?= htmlspecialchars($destination['name']); ?>" class="hero-image-placeseach"/>
            <div class="hero-content-placeseach">
                <h1 class="hero-title-placeseach"><?= htmlspecialchars($destination['name']); ?></h1>

                <!-- ====== share & bookmarks ===== -->
                <div class="social-icons-placeseach">
                    <img src="../assets/share-icon.png" 
                        alt="Share on social media" 
                            class="social-icons-placeseach"/>
                <form method="POST" action="">
                        <input type="hidden" name="bookmark_action" value="<?= $is_bookmarked ? 'remove' : 'add'; ?>">
                        <button type="submit">
                            <img src="../assets/bookmark-icon.png" 
                                 alt="<?= $is_bookmarked ? 'Remove from favorites' : 'Save to favorites'; ?>"
                                 class="bookmark-icon-eventeach"/>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- ====== navigasi back to placelist ===== -->
        <nav class="breadcrumb-placeseach" aria-label="Breadcrumb navigation">
            <div class="breadcrumb-list-placeseach">
                <a href="place-list.html" class="back-nav-placeseach">Places</a>
                <span>/</span>
                <span><?= htmlspecialchars($destination['name']); ?></span>
            </div>
        </nav>

        <!-- ======== KONTEN ARTIKEL ======== -->
        <main class="main-content-placeseach">
            <article class="content-description-placeseach">
                <h2 class="content-subtitle-placeseach"><?= htmlspecialchars($destination['title']); ?></h2>
                <p class="content-text-placeseach"><?= nl2br(htmlspecialchars($destination['description'])); ?></p>
            </article>

            <!-- ======== GALLERY ======== -->
            <section class="gallery-placeseach" aria-label="Photo gallery">
                <?php foreach ($images as $image): ?>
                    <img src="/images/destinations/<?= htmlspecialchars($image['photo']); ?>" alt="Image of <?= htmlspecialchars($destination['name']); ?>" class="gallery-main-placeseach"/>
                <?php endforeach; ?>
            </section>
        </main>

        <?php include_once __DIR__ . "/template/footer.php"; ?>
        
    </div>

</body>
</html>
