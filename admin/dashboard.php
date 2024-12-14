<?php
if (!session_id())
    session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ ."/../middleware/middleware.php";
isLoggedIn();
isAdmin();

// Fetch the total number of users
$query_users = "SELECT COUNT(*) as total_users FROM users";
$stmt_users = $dbs->prepare($query_users);
$stmt_users->execute();
$data_users = $stmt_users->get_result();
$total_users = $data_users->fetch_assoc()['total_users'];
$stmt_users->close();

// Fetch the total number of destinations
$query_destinations = "SELECT COUNT(*) as total_destinations FROM destinations";
$stmt_destinations = $dbs->prepare($query_destinations);
$stmt_destinations->execute();
$data_destinations = $stmt_destinations->get_result();
$total_destinations = $data_destinations->fetch_assoc()['total_destinations'];
$stmt_destinations->close();

// Fetch the total number of events
$query_events = "SELECT COUNT(*) as total_events FROM events";
$stmt_events = $dbs->prepare($query_events);
$stmt_events->execute();
$data_events = $stmt_events->get_result();
$total_events = $data_events->fetch_assoc()['total_events'];
$stmt_events->close();

// Combine total destinations and total events
$total_postings = $total_destinations + $total_events;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/../template/meta.php";?>
    <title>Statistics - OasisSeek</title>
</head>
<body>
    <?php include_once __DIR__ . "/../template/navbar.php";?>

    <div class="statistics-container">
        <p>Total Users: <?= htmlspecialchars($total_users); ?></p>
        <p>Total Post <?= htmlspecialchars($total_postings); ?></p>
    </div>

    <?php include_once __DIR__ . "/../template/footer.php";?>
</body>
</html>
