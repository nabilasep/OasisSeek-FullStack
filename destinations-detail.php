<?php
if (!session_id())
session_start();
include_once __DIR__ . "/database/database.php";

// Check if des_id or id is set
$des_id = isset($_GET['des_id']) ? $_GET['des_id'] : (isset($_GET['id']) ? $_GET['id'] : null);

if ($des_id === null) {
    header('Location: /destinations.php');
    exit();
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Places Each - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="placeseach-wrapper">
    <!-- ======== HEADER ======== -->
    <div class="landing-container">
        
    <?php include_once __DIR__ . "/template/navbar.php";?>

        <!-- ======== HERO SECTION ======== -->
        <section class="hero-section-placeseach">
            <img src="/images/destinations/<?= $destination['banner']; ?>" alt="Scenic view of <?= htmlspecialchars($destination['name']); ?>" class="hero-image-placeseach"/>
            <div class="hero-content-placeseach">
                <h1 class="hero-title-placeseach"><?= htmlspecialchars($destination['name']); ?></h1>
                <!-- ====== share & bookmarks ===== -->
                <div class="social-icons-placeseach">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1a5b77927d2c9a207ab80441ad049d5471fb8745dd1875a1b0991113adc08374?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                         alt="Share on social media" class="social-icons-placeseach"/>
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a0dd4d9bd331673a77e14d9cb571d3363609183ba53792017a218736f117f553?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                         alt="Save to favorites" class="social-icon-placeseach"/>
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
