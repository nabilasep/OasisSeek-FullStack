<?php 
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

// Check if event_id or id is set
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : (isset($_GET['id']) ? $_GET['id'] : null);

if ($event_id === null) {
    header('Location: /events.php');
    exit();
}

// Fetch event details
$query = "SELECT name, title, description, location, date, time, banner FROM events WHERE event_id = ?";
$stmt = $dbs->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $dbs->error);
}
$stmt->bind_param("i", $event_id);
$stmt->execute();
$data = $stmt->get_result();
$event = $data->fetch_assoc();
$stmt->close();

if (!$event) {
    header("Location: /events.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Event Each - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
   <!-- ======== HEADER ======== -->
   <div class="landing-container">

   <?php include_once __DIR__. "/template/navbar.php"; ?>

  <!-- ======== HERO EVENT-EACH ======== -->
    <section class="hero-section-eventeach">
    <img src="/images/events/<?= htmlspecialchars($event['banner']); ?>" alt="Scenic view of <?= htmlspecialchars($event['name']); ?>" class="hero-content-eventeach"/>
        <h1 class="hero-title-eventeach"><?= htmlspecialchars($event['name']); ?></h1>
        <div class="social-icons-eventeach">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/aca7b8473ce7bffecac061d6d110d5857879ca071f7925b46bb7be0144274003?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" class="social-icon-eventeach" />
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2a22b5334bb3e00ec4ce5a14eceefa3de094ee014220f6b31c5a0d71d0a4d134?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" class="social-icon-eventeach" />
        </div>
      </div>
    </section>
    <nav class="breadcrumb-eventeach" aria-label="Breadcrumb">
      <div class="breadcrumb-list-eventeach">
        <a href="event-list.html" class="back-nav-eventeach">Events</a>
        <span>/</span>
        <span><?= htmlspecialchars($event['name']); ?></span>
      </div>
    </nav>

    <!-- ======== EVENT KONTEN ======== -->
    <main class="eventeach-content">
      <article>
        <h2 class="eventeach-title"><?= htmlspecialchars($event['title']); ?></h2>
        <p class="eventeach-description">
          <?= nl2br(htmlspecialchars($event['description'])); ?>
        </p>
      </article>

      <!-- ======== EVENT INFO ======== -->
      <section class="eventeach-details">
        <div class="info-section-eventeach">
          <h3 class="info-title-eventeach">Event information</h3>
          <div class="info-grid-eventeach">
            <div class="info-label-eventeach">Location</div>
            <div class="info-value-eventeach"><?= htmlspecialchars($event['location']); ?></div>
            <div class="info-label-eventeach">Date</div>
            <div class="info-value-eventeach"><?= htmlspecialchars($event['date']); ?></div>
            <div class="info-label-eventeach">Time</div>
            <div class="info-value-eventeach"><?= htmlspecialchars($event['time']); ?></div>
          </div>
        </div>

        <!-- ======== MAPS EVENT ======== -->

      </section>
    </main>

    <!-- =========== FOOTER =========== -->
    <?php include_once __DIR__ . "/template/footer.php"; ?>

    <script>
        // Your testing script here if needed
    </script>
  
  </body>
</html>
