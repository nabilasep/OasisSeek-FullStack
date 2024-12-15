<?php
// php -S localhost:3000
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

$query = "SELECT des_id, name, banner FROM destinations ORDER BY des_id LIMIT 4";


$destinations = getData($dbs, $query);

//event
$query = "SELECT event_id, name, date, banner FROM events ORDER BY event_id DESC LIMIT 3";

$events = getData($dbs, $query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/template/meta.php"; ?>
    <link rel="stylesheet" type="text/css" href="/images/assets/styles.css" />
    <title>Document</title>
</head>

<body>
    <div class="landing-container">
        <?php include_once __DIR__ . "/template/navbar.php"; ?>

        <!-- ======== BERANDA ======== -->
    <section class="hero-section">
      <img src="../assets/landing-page.png" alt="Egyptian landscape panorama" class="hero-img" />
      <div class="hero-content">
        <p class="hero-subtitle">DISCOVER EGYPT</p>
        <h2 class="hero-title">Experience Unforgettable Landscape, Relive History!</h2>
        <a href="#main-content" class="cta-button-explore">Explore more</a>
      </div>
    </section>
  

         <main class="main-content" id="main-content">
            <!-- ======== DESTINASI ======== -->
            <section class="destinations-section">
            <h2 class="section-title">POPULAR DESTINATIONS</h2>
            <div class="destinations-grid">
                    <?php foreach ($destinations as $destination): ?>
                        <article class="destination-card">
                            <img src="/images/<?= $destination['banner']; ?>" alt="image of <?= $destination['name']; ?>"
                                class="destination-img" />
                            <h3 class="destination-name">
                                <?= $destination['name']; ?>
                            </h3>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

           <!-- ========= EVENT ========= -->
             <section class="events-section">
              <div class="events-content">
                    <h2 class="events-heading">WHAT'S ON</h2>
                        <p class="events-description">Dive into rich history, stunning landscapes, and cultural experiences that will leave you inspired.</p>
                    <a href="events.php" class="cta-button-discover"><b>Discover more events</b></a>
                 </div>
                    <?php foreach ($events as $event): ?>
                    <img src="/images/<?= $event['banner']; ?>"alt="image of <?= $event['name']; ?>">
                    <?php endforeach; ?>
          
                </div>
            </section>

              <!-- ========== GALLERY ========== -->
            <section class="gallery-section">
                <h2 class="gallery-heading">GALLERY</h2>
                <p class="gallery-subtitle">A glimpse of heaven on earth were found in Egypt.</p>
                <div class="gallery-grid">
                <img src="/images/assets/gallery1.png" alt="Egyptian landscape" class="gallery-main gallery-img" />
                <div class="gallery-side">
                <img src="/images/assets/gallery2.png" alt="Historical site" class="gallery-img" />
                <div class="gallery-row">
              <img src="/images/assets/gallery3.png" alt="Cultural scene" class="gallery-img" />
              <img src="/images/assets/gallery4.png" alt="Traditional architecture" class="gallery-img" />
            </div>
          </div>
        </div>
      </section>
    </main>

        <?php include_once __DIR__ . "/template/footer.php"; ?>
    </div>
</body>

</html>