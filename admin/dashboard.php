<?php
if (!session_id())
    session_start();


include_once __DIR__ . "/../database/database.php";
include_once __DIR__ . "/../middleware/middleware.php";
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
    <?php include_once __DIR__ . "/../template/meta.php"; ?>
    <title>Statistics - OasisSeek</title>
    <style>
        .stats-grid {
            display: flex;
            margin-top: 31px;
            align-items: center;
            gap: 36px;
            font-family: Poppins, sans-serif;
            justify-content: start;
            flex-wrap: wrap;
        }

        .stats-card {
            border-radius: 0;
            align-self: stretch;
            display: flex;
            min-width: 240px;
            flex-direction: column;
            width: 327px;
            margin: auto 0;
        }

        .card-content {
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            width: 100%;
            flex-direction: column;
            align-items: start;
            justify-content: center;
            padding: 31px;
        }

        @media (max-width: 991px) {
            .card-content {
                padding: 0 20px;
            }
        }

        .stats-wrapper {
            display: flex;
            align-items: end;
            gap: 23px;
            justify-content: start;
        }

        .stats-icon {
            aspect-ratio: 1;
            object-fit: contain;
            object-position: center;
            width: 73px;
        }

        .stats-info {
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        .stats-number {
            color: black;
            font-size: 30px;
            font-family: 'Sora', sans-serif;
            font-weight: 600;
        }

        .stats-label {
            color: rgb(116, 113, 113);
            font-size: 20px;
            margin-top: 17px;
        }
    </style>
</head>

<body>
    <div class="container-dashboard">

        <?php include_once __DIR__ . "/../template/navbarAdm.php"; ?>

        <!-- ======= MAIN DASHBOARD ========  -->
        <div class="main-dashboard">
            <div class="dashboard">
                <!-- ======= MAIN DASHBOARD ========  -->
                <div class="main-dashboard">
                    <div class="dashboard">

                        <!-- ===== Header =======  -->
                        <header class="dashboard-header">
                            <h1 class="page-title-dashboard">Dashboard</h1>
                            <div class="user-profile-dashboard">
                                <img class="profile-icon-dashboard" src="../assets/profile-admin.png"
                                    alt="User profile" />
                                <div class="profile-text-dashboard">Admin</div>
                            </div>
                        </header>

                        <!-- ===== Konten Stats ======= -->
                        <div class="dashboard-content">
                            <section class="stats-grid" aria-label="Dashboard Statistics">
                                <div class="stats-card">
                                    <div class="card-content">
                                        <div class="stats-wrapper"> <img class="stats-icon"
                                                src="../assets/stats-icon1.png" alt="Users icon" />
                                            <div class="stats-info">
                                                <div class="stats-number"><?= htmlspecialchars($total_users); ?></div>
                                                <div class="stats-label">Total Users</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stats-card">
                                    <div class="card-content">
                                        <div class="stats-wrapper"> <img class="stats-icon"
                                                src="../assets/stats-icon2.png" alt="Posts icon" />
                                            <div class="stats-info">
                                                <div class="stats-number"><?= htmlspecialchars($total_postings); ?>
                                                </div>
                                                <div class="stats-label">Total Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>