<?php
// php -S localhost:3000
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

// Setting up pagination variables
$limit = 16;
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$off = ($page * $limit) - $limit;

// Handling search input
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_date = isset($_GET['search_date']) ? $_GET['search_date'] : '';

// Constructing the base query
$query_base = "SELECT event_id, name, date, banner FROM events WHERE 1=1";

// Adding conditions for search
if ($search_name) {
    $query_base .= " AND name LIKE ?";
}
if ($search_date) {
    $query_base .= " AND date = ?";
}

// Preparing the count query
$total_query = "SELECT COUNT(*) as total FROM ($query_base) as count_query";
$stmt = $dbs->prepare($total_query);

// Binding parameters for count query
if ($search_name && $search_date) {
    $stmt->bind_param("ss", $search_name_param, $search_date);
    $search_name_param = "%" . $search_name . "%";
} elseif ($search_name) {
    $stmt->bind_param("s", $search_name_param);
    $search_name_param = "%" . $search_name . "%";
} elseif ($search_date) {
    $stmt->bind_param("s", $search_date);
}

// Executing the count query
$stmt->execute();
$data = $stmt->get_result();
$total = $data->fetch_array(MYSQLI_ASSOC)['total'];
$stmt->close();

$total_pages = ceil($total / $limit); // Calculate total pages

// Preparing the main query with pagination
$query = $query_base . " ORDER BY event_id DESC LIMIT ? OFFSET ?";
$stmt = $dbs->prepare($query);

// Binding parameters for main query
if ($search_name && $search_date) {
    $stmt->bind_param("ssii", $search_name_param, $search_date, $limit, $off);
} elseif ($search_name) {
    $stmt->bind_param("sii", $search_name_param, $limit, $off);
} elseif ($search_date) {
    $stmt->bind_param("sii", $search_date, $limit, $off);
} else {
    $stmt->bind_param("ii", $limit, $off);
}

// Executing the main query
$stmt->execute();
$data = $stmt->get_result();
$events = $data->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Event List - OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="/images/assets/styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- ======== HEADER ======== -->
    <div class="landing-container">

        <?php include_once __DIR__ . "/template/navbar.php"; ?>

        <!-- ======== HERO SECTION ======== -->
        <section class="hero-section-eventlist">
            <img src="/images/assets/event.png" class="hero-image-eventlist" />
            <h1 class="hero-title-eventlist">Event</h1>
        </section>

        <div class="jumbotron">
            <!-- ======== SEARCH BAR ======== -->
            <div class="search-container">
                <form method="GET" action="" id="search-form">
                    <div class="filter-item"> <label for="name">Name</label> <input type="text" name="search_name"
                            placeholder="Search by name" value="<?= htmlspecialchars($search_name); ?>">
                    </div>
                    <div class="filter-item"> <label for="date">Date</label> <input type="date" name="search_date"
                            placeholder="Search by date" value="<?= htmlspecialchars($search_date); ?>">
                    </div>
                    <button class="search-button" type="submit" form="search-form">Search</button>
                </form>
            </div>

            <!-- ======== UPCOMING LIST CONTAINER ======== -->
            <div class="upcoming-container">
                <h2 class="upcoming-event-title">Upcoming Event</h2>
                <div class="eventlist-grid">
                    <!-- row 1 -->
                    <div class="events-gallery">
                        <?php foreach ($events as $event): ?>

                            <article class="event-card" tabindex="0">
                                <img loading="lazy" src="/images/events/<?= $event["banner"] ?>" class="eventlist-image"
                                    alt="<?= $event['name'] ?>" />
                                <a href="/events_detail.php?id=<?= $event['event_id'] ?>l" class="event-details">
                                    <div class="event-info">
                                        <h2 class="event-title"><?= $event['name'] ?></h2>
                                        <time class="event-date"
                                            datetime="<?= $event['date'] ?>"><?= $event['date'] ?></time>
                                    </div>
                                </a>
                            </article>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="events-gallery">
            <?php foreach ($events as $event): ?>
                <article class="event-card-home" tabindex="0">
                    <img loading="lazy" src="/images/events/<?= $event['banner']; ?>"alt="image of <?= $event['name']; ?>" class="event-image-home">
                      <a href="events_detail.php" class="event-details-home">
                        <div class="event-info-home">
                          <h2 class="event-title-home"><br><?= $event['name']; ?></h2>
                          <h2 class="event-date-home" ><br><?= $event['date']; ?></h2>
                        </div>
                      </a>
                      </article>
                    <?php endforeach; ?>
                    
              </div>
            </section> -->

        <!-- Pagination links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a
                    href="?page=<?= $page - 1; ?>&search_name=<?= htmlspecialchars($search_name); ?>&search_date=<?= htmlspecialchars($search_date); ?>">&laquo;
                    Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i; ?>&search_name=<?= htmlspecialchars($search_name); ?>&search_date=<?= htmlspecialchars($search_date); ?>"
                    <?php if ($i == $page)
                        echo 'class="active"'; ?>><?= $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a
                    href="?page=<?= $page + 1; ?>&search_name=<?= htmlspecialchars($search_name); ?>&search_date=<?= htmlspecialchars($search_date); ?>">Next
                    &raquo;</a>
            <?php endif; ?>
        </div>
        </main>

        <!-- =========== FOOTER =========== -->
        <?php include_once __DIR__ . "/template/footer.php"; ?>

</body>

</html>