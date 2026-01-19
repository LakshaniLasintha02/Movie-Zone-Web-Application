<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About - Movie Zone</title>
<link rel="stylesheet" href="style.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: sans-serif; }

/* ===== Fullscreen Header ===== */
.header {
    background: #ffffff !important;
    animation: none !important; 
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Navigation */
nav {
    display: flex;
    position: fixed;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background: rgba(1,5,21,0.9);
    width: 100%;
    top: 0;
    z-index: 1000;
}
.nav-links ul { list-style:none; display:flex; gap:20px; }
.nav-links ul li a { text-decoration:none; color:#fff; font-size:16px; transition: color 0.3s; }
.nav-links ul li a:hover { color:#f44336; }
.btn-signin { text-decoration:none; color:#fff; background:#f44336; padding:8px 15px; border-radius:5px; cursor:pointer; transition: background 0.3s; }
.btn-signin:hover { background:#d32f2f; }

/* Centered Content */
.content {
    color: #333;
    text-align: center;
    max-width: 700px;
    padding: 0 20px;
}
.content h1 { font-size: 48px; margin-bottom:20px; }
.content p { font-size:20px; line-height:1.6; }

@media(max-width:768px){
    .content h1 { font-size:36px; }
    .content p { font-size:16px; }
    nav { padding: 15px 20px; }
    .nav-links ul { gap:10px; }
}
</style>
</head>
<body>

<section class="header">
    <!-- Navigation -->
    <nav>
        <div class="nav-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="dramas.php">Dramas</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- Sign In / Welcome Button -->
        <?php if(isset($_SESSION['user_name'])): ?>
            <a href="logout.php" class="btn-signin">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> | Logout</a>
        <?php else: ?>
            <a href="signIn.php" class="btn-signin">SIGN IN</a>
        <?php endif; ?>
    </nav>

    <!-- Centered About Content -->
    <div class="content">
        <h1>About Movie Zone</h1>
        <p>Welcome to Movie Zone, your ultimate destination for discovering the latest movies and dramas. We aim to provide users with an easy-to-use platform to explore films, check showtimes, and stay updated with the entertainment world.</p>
    </div>
</section>

</body>
<?php include 'footer.php'; ?>
</html>


