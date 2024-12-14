<?php
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . "/../template/meta.php";?>
    <title>Document</title>
</head>
<body>
    <?php include_once __DIR__ . "/../template/navbar.php";?>

    <div class="statistics-container"> 
    <p>Total Destinations: <?= htmlspecialchars($total_destinations); ?></p>
    <p>Total Events: <?= htmlspecialchars($total_events); ?></p>
    </div>

    <?php include_once __DIR__ . "/../template/footer.php";?>

</body>
</html>