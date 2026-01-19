<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}
include 'db.php';

// Handle drama form
if (isset($_POST['add_drama'])) {
    $title = $_POST['title'];
    $releaseYear = $_POST['releaseYear'];
    $description = $_POST['description'];
    $poster = $_FILES['poster']['name'];
    $genres = $_POST['genres'];

    // Upload poster
    $target_dir = "img/";
    $target_file = $target_dir . basename($poster);
    move_uploaded_file($_FILES['poster']['tmp_name'], $target_file);

    // Insert into Dramas
    $stmt = $conn->prepare("INSERT INTO Dramas (Title, ReleaseYear, Description, Poster) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $title, $releaseYear, $description, $poster);
    $stmt->execute();
    $dramaID = $stmt->insert_id;

    // Insert genres
    foreach ($genres as $genreID) {
        $stmt2 = $conn->prepare("INSERT INTO DramaGenres (DramaID, GenreID) VALUES (?, ?)");
        $stmt2->bind_param("ii", $dramaID, $genreID);
        $stmt2->execute();
    }

    echo "<p style='color:green; text-align:center;'>Drama added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Add Drama</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .admin-container {
      width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .admin-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .admin-container input, .admin-container textarea, .admin-container select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .admin-container button {
      width: 100%;
      padding: 12px;
      background: #f44336;
      border: none;
      color: #fff;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    .admin-container button:hover {
      background: #d32f2f;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="admin-container">
  <h2>Add New Drama</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Drama Title" required>
    <input type="number" name="releaseYear" placeholder="Release Year" required>
    <textarea name="description" placeholder="Drama Description" required></textarea>
    <input type="file" name="poster" accept="image/*" required>

    <label>Select Genres:</label>
    <select name="genres[]" multiple required>
      <?php
      $genres = $conn->query("SELECT * FROM Genres");
      while($row = $genres->fetch_assoc()) {
        echo "<option value='".$row['GenreID']."'>".$row['GenreName']."</option>";
      }
      ?>
    </select>

    <button type="submit" name="add_drama">Add Drama</button>
  </form>
</div>

</body>
</html>
