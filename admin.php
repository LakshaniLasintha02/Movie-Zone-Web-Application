<?php
include 'db.php';

// Handle form submission
if (isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $releaseYear = $_POST['releaseYear'];
    $description = $_POST['description'];
    $poster = $_FILES['poster']['name'];
    $genres = $_POST['genres']; // array of selected genres

    // Upload poster image to img folder
    $target_dir = "img/";
    $target_file = $target_dir . basename($poster);
    move_uploaded_file($_FILES['poster']['tmp_name'], $target_file);

    // Insert into Movies table
    $stmt = $conn->prepare("INSERT INTO Movies (Title, ReleaseYear, Description, Poster) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $title, $releaseYear, $description, $poster);
    $stmt->execute();
    $movieID = $stmt->insert_id;

    // Insert into MovieGenres table
    foreach ($genres as $genreID) {
        $stmt2 = $conn->prepare("INSERT INTO MovieGenres (MovieID, GenreID) VALUES (?, ?)");
        $stmt2->bind_param("ii", $movieID, $genreID);
        $stmt2->execute();
    }

    echo "<p style='color:green; text-align:center;'>Movie added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Add Movie</title>
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
      margin-bottom: 20px;
      text-align: center;
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


<div class="admin-container">
  <h2>Add New Movie</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Movie Title" required>
    <input type="number" name="releaseYear" placeholder="Release Year" required>
    <textarea name="description" placeholder="Movie Description" required></textarea>
    <input type="file" name="poster" accept="image/*" required>

    <label>Select Genres:</label>
    <select name="genres[]" multiple required>
      <?php
      // fetch genres from DB
      $genres = $conn->query("SELECT * FROM Genres");
      while($row = $genres->fetch_assoc()) {
        echo "<option value='".$row['GenreID']."'>".$row['GenreName']."</option>";
      }
      ?>
    </select>

    <button type="submit" name="add_movie">Add Movie</button>
  </form>
  <a href="admin_logout.php" style="color:#f44336; font-weight:bold;">Logout</a>

</div>

</body>
</html>
