<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// Fetch stats for cards
$totalMovies = $conn->query("SELECT COUNT(*) as total FROM movies")->fetch_assoc()['total'];
$totalDramas = $conn->query("SELECT COUNT(*) as total FROM dramas")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Roboto', sans-serif; }
body { background:#f0f2f5; }

/* Sidebar */
.sidebar {
    position: fixed;
    left:0; top:0;
    width:220px; height:100%;
    background:#1f1f2e;
    color:#fff;
    display:flex;
    flex-direction:column;
    padding-top:20px;
}
.sidebar h2 { text-align:center; margin-bottom:20px; font-size:22px; color:#f44336; }
.sidebar a {
    display: flex;
    align-items:center;
    color:#fff; text-decoration:none;
    padding:12px 20px;
    margin-bottom:5px;
    border-left:4px solid transparent;
    transition:0.3s; font-weight:500;
}
.sidebar a:hover { background:#2a2a40; border-left:4px solid #f44336; }

/* Topbar */
.topbar {
    margin-left:220px;
    height:60px;
    background:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}
.topbar .admin-info { font-weight:500; color:#333; }
.topbar .logout-btn { background:#f44336; color:#fff; padding:8px 15px; border-radius:6px; text-decoration:none; transition:0.3s; }
.topbar .logout-btn:hover { background:#d32f2f; }

/* Main content */
.main { margin-left:220px; padding:30px; }
.main h1 { margin-bottom:20px; color:#333; }

/* Cards */
.cards { display:flex; gap:20px; margin-bottom:20px; flex-wrap:wrap; }
.card {
    flex:1;
    min-width:200px;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    text-align:center;
}
.card h3 { margin-bottom:10px; color:#f44336; }
.card p { font-size:24px; font-weight:500; color:#333; }

/* Buttons */
button, .card-btn {
    padding:8px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
    margin-top:10px;
    display:inline-block;
    text-decoration:none;
    color:#fff;
    background:#f44336;
}
button:hover, .card-btn:hover { background:#d32f2f; }

</style>
</head>
<body>

<div class="sidebar">
    <h2>MovieZone Admin</h2>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_movies.php">Manage Movies</a>
    <a href="admin_dramas.php">Manage Dramas</a>
    <a href="admin_logout.php">Logout</a>
</div>

<div class="topbar">
    <div class="admin-info">Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></div>
    <a href="admin_logout.php" class="logout-btn">Logout</a>
</div>

<div class="main">
    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h3>Total Movies</h3>
            <p><?php echo $totalMovies; ?></p>
            <a href="admin_movies.php" class="card-btn">Manage Movies</a>
        </div>
        <div class="card">
            <h3>Total Dramas</h3>
            <p><?php echo $totalDramas; ?></p>
            <a href="admin_dramas.php" class="card-btn">Manage Dramas</a>
        </div>
    </div>

</div>

</body>
</html>




