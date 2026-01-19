<?php
session_start();
include 'db.php'; // database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dramas - MovieZone</title>
<link rel="stylesheet" href="style.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: sans-serif; }

/* Navbar */
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
nav .nav-links ul { list-style:none; display:flex; gap:20px; }
nav .nav-links ul li a { text-decoration:none; color:#fff; font-size:16px; transition: color 0.3s; }
nav .nav-links ul li a:hover { color:#f44336; }
.btn-signin { text-decoration:none; color:#fff; background:#f44336; padding:8px 15px; border-radius:5px; cursor:pointer; transition: background 0.3s; }
.btn-signin:hover { background:#d32f2f; }

body {
  font-family: Arial, sans-serif;
  background: #f7f7f7;
  margin: 0;
  padding-top: 80px;
}

h1 {
  text-align: center;
  margin: 30px 0 20px;
  color: #222;
}

/* Category Bar */
.category-section h2 {
  margin: 0;
  padding: 15px 30px;
  font-size: 22px;
  font-weight: bold;
  color: #fff;
  width: 100%;
  background: linear-gradient(90deg, #000000, #222222);
  cursor: pointer;
  transition: background 0.3s, transform 0.3s;
}
.category-section h2:hover {
  background: linear-gradient(90deg, #111111, #333333);
  transform: scale(1.02);
}

/* Scrollable Dramas Row */
.scroll-wrapper {
  position: relative;
  margin-bottom: 40px;
  width: 100%;
  overflow: hidden;
}
.dramas-container {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  gap: 20px;
  padding: 15px 0;
  scroll-behavior: smooth;
}
.dramas-container::-webkit-scrollbar { display: none; }

/* Scroll buttons */
.scroll-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0,0,0,0.5);
  border: none;
  color: #fff;
  font-size: 28px;
  padding: 10px;
  cursor: pointer;
  border-radius: 50%;
  z-index: 10;
  transition: background 0.3s;
}
.scroll-btn:hover { background-color: rgba(0,0,0,0.8); }
.left-btn { left: 0; }
.right-btn { right: 0; }

/* Drama Card */
.drama-card {
  width: 200px;
  height: 440px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  overflow: hidden;
  text-align: center;
  transition: transform 0.3s ease;
  flex: 0 0 auto;
}
.drama-card:hover { transform: translateY(-5px); }
.drama-card img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}
.drama-card h3 {
  margin: 10px 5px 5px;
  font-size: 17px;
  color: #333;
  line-height: 1.2;
}
.drama-card p {
  font-size: 13px;
  color: #555;
  padding: 0 10px 10px 10px;
  height: 120px;
  overflow: hidden;
}

/* Responsive adjustments */
@media(max-width:768px){
    .category-section h2 { font-size: 18px; padding:10px 20px; }
    .drama-card { width: 150px; height: 360px; }
    .drama-card img { height: 250px; }
}
</style>
</head>
<body>

<!-- Navbar -->
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

  <?php if(isset($_SESSION['user_name'])): ?>
      <a href="logout.php" class="btn-signin">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> | Logout</a>
  <?php else: ?>
      <a href="signIn.php" class="btn-signin">SIGN IN</a>
  <?php endif; ?>
</nav>

<h1>Our Dramas Collection</h1>

<?php
$categories = ["New Release", "Famous", "Korean", "Other Asian Dramas", "Chinese"];

foreach ($categories as $category) {
    echo "<div class='category-section'>";
    echo "<h2>$category</h2>";
    echo "<div class='scroll-wrapper'>";
    echo "<button class='scroll-btn left-btn'>&#10094;</button>";
    echo "<div class='dramas-container'>";

    $sql = "SELECT * FROM Dramas WHERE Category = '$category' ORDER BY ReleaseYear DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($drama = $result->fetch_assoc()) {
            ?>
            <div class="drama-card">
                <img src="<?php echo $drama['Poster']; ?>" alt="<?php echo htmlspecialchars($drama['Title']); ?>">
                <h3><?php echo htmlspecialchars($drama['Title']); ?> (<?php echo $drama['ReleaseYear']; ?>)</h3>
                <p><?php echo substr($drama['Description'], 0, 60); ?>...</p>
            </div>
            <?php
        }
    } else {
        echo "<p style='margin-left:30px;'>No dramas in this category.</p>";
    }

    echo "</div>"; // dramas-container
    echo "<button class='scroll-btn right-btn'>&#10095;</button>";
    echo "</div>"; // scroll-wrapper
    echo "</div>"; // category-section
}
?>

<script>
// Scroll buttons
document.querySelectorAll('.category-section').forEach(section => {
    const leftBtn = section.querySelector('.left-btn');
    const rightBtn = section.querySelector('.right-btn');
    const container = section.querySelector('.dramas-container');

    leftBtn.addEventListener('click', () => {
        container.scrollBy({ left: -250, behavior: 'smooth' });
    });
    rightBtn.addEventListener('click', () => {
        container.scrollBy({ left: 250, behavior: 'smooth' });
    });
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>


