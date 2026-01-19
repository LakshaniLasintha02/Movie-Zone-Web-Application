<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - Movie Zone</title>
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
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background: rgba(1,5,21,0.9);
    width: 100%;
    position: fixed;
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
.content p { font-size:20px; line-height:1.6; margin-bottom:20px; }
.content form input, .content form textarea {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.content form button {
    padding: 12px 20px;
    border: none;
    background: #f44336;
    color: #fff;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
}
.content form button:hover { background: #d32f2f; }

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

    <!-- Feedback messages -->
    <div class="content">
     <?php
          if(isset($_SESSION['contact_success'])) {
              echo '<p style="color:green; font-weight:bold; margin-bottom:15px;">'.$_SESSION['contact_success'].'</p>';
              unset($_SESSION['contact_success']);
          }
          if(isset($_SESSION['contact_error'])) {
              echo '<p style="color:red; font-weight:bold; margin-bottom:15px;">'.$_SESSION['contact_error'].'</p>';
              unset($_SESSION['contact_error']);
          }
     ?>
    </div>

    <!-- Centered Contact Content -->
    <div class="content">
        <h1>Contact Us</h1>
        <p>If you have any questions, suggestions, or feedback, feel free to reach out using the form below.</p>
        <form method="post" action="contact_submit.php">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
            <button type="submit" name="submit">Send Message</button>
        </form>
    </div>
</section>

</body>
<?php include 'footer.php'; ?>
</html>

