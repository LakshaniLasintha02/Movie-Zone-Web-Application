<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movie Zone</title>
<link rel="stylesheet" href="style.css">
<style>
/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

html, body {
    height: 100%;
}

/* Navigation */
nav {
    position: fixed;
    top: 0;
    width: 100%;
    height: 70px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
    background: rgba(3, 6, 20, 0.3);
    z-index: 1000;
}

.nav-links ul {
    list-style:none;
    display:flex;
    gap:20px;
}

.nav-links ul li a {
    text-decoration:none;
    color:#fff;
    font-size:16px;
    transition: color 0.3s;
}

.nav-links ul li a:hover { color:#f44336; }

.btn-signin {
    text-decoration:none;
    color:#fff;
    background:#f44336;
    padding:8px 15px;
    border-radius:5px;
    cursor:pointer;
}

.btn-signin:hover { background:#d32f2f; }

/* Full-screen Header */
.header {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    background-size: cover;
    background-position: center;
    animation: slideBG 35s infinite;
    color: #fff;
    text-align: center;
    padding-top: 70px; /* space for navbar */
}

/* Dark overlay */
.header::before {
    content: "";
    position: absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color: rgba(0,0,0,0.5);
    z-index:1;
}

/* Content above overlay */
.header .content {
    position: relative;
    z-index:2;
    max-width: 800px;
    padding: 20px;
}

/* Headings */
.header .content h1 { font-size:48px; margin-bottom:20px; }
.header .content p { font-size:20px; line-height:1.6; }

/* Slideshow animation */
@keyframes slideBG {
    0%   { background-image: url('img/home6.jpg'); }
    20%  { background-image: url('img/home1.jpg'); }
    40%  { background-image: url('img/home3.jpg'); }
    60%  { background-image: url('img/home7.jpg'); }
    80%  { background-image: url('img/home9.jpg'); }
    100% { background-image: url('img/home5.jpg'); }
}

/* Responsive adjustments */
@media(max-width:768px){
    .header .content h1 { font-size:36px; }
    .header .content p { font-size:16px; }
    nav { padding: 0 20px; }
    .nav-links ul { gap: 10px; }
}
</style>
</head>
<body>

<section class="header">
    <!-- Navigation -->
    <nav>
        <div class="nav-links">
            <ul id="navList">
                <li><a href="index.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="dramas.php">Dramas</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- SIGN IN / WELCOME & ADMIN LOGIN -->
        <div style="display:flex; gap:10px; align-items:center;">
            <?php if(isset($_SESSION['user_name'])): ?>
                <a href="logout.php" class="btn-signin">
                    Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> | Logout
                </a>
            <?php else: ?>
                <a href="signIn.php" class="btn-signin">SIGN IN</a>
            <?php endif; ?>

            <!-- Admin Login / Dashboard -->
            <?php if(!isset($_SESSION['is_admin'])): ?>
                <a href="admin_login.php" class="btn-signin">Admin Login</a>
            <?php else: ?>
                <a href="admin_dashboard.php" class="btn-signin">Dashboard</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Centered Content -->
    <div class="content">
        <h1>Welcome to Movie Zone</h1>
        <p>Discover the latest movies and dramas. Sign in to explore personalized content!</p>
    </div>
</section>

<!-- Display login error (if redirected from signIn.php) -->
<?php 
if(isset($_SESSION['login_error'])){
    echo '<p style="color:red; font-weight:bold; margin-bottom:10px; text-align:center;">'
         .$_SESSION['login_error'].'</p>';
    unset($_SESSION['login_error']); 
}
?>

<?php include 'footer.php'; ?>

</body>
</html>












