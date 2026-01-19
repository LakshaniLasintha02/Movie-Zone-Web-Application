<?php
include 'db.php';

// Add new genre
if (isset($_POST['add_genre'])) {
    $genreName = trim($_POST['genreName']);

    if (!empty($genreName)) {
        $stmt = $conn->prepare("INSERT INTO Genres (GenreName) VALUES (?)");
        $stmt->bind_param("s", $genreName);
        if ($stmt->execute()) {
            $message = "Genre added successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
    } else {
        $message = "Genre name cannot be empty.";
    }
}
<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>


// Delete genre
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM Genres WHERE GenreID = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "Genre deleted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Genres</title>
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
    .admin-container input {
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
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    table th, table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    table th {
      background: #f2f2f2;
    }
    .delete-btn {
      color: #f44336;
      text-decoration: none;
      font-weight: bold;
    }
    .delete-btn:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="admin-container">
  <h2>Manage Genres</h2>

  <?php if (!empty($message)) echo "<p style='color:green; text-align:center;'>$message</p>"; ?>

  <!-- Add Genre Form -->
  <form method="post">
    <input type="text" name="genreName" placeholder="Enter genre name" required>
    <button type="submit" name="add_genre">Add Genre</button>
  </form>

  <!-- Genre List -->
  <table>
    <tr>
      <th>ID</th>
      <th>Genre Name</th>
      <th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM Genres ORDER BY GenreID ASC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['GenreID']."</td>
                <td>".$row['GenreName']."</td>
                <td><a class='delete-btn' href='genres.php?delete=".$row['GenreID']."' onclick=\"return confirm('Delete this genre?');\">Delete</a></td>
              </tr>";
    }
    ?>
  </table>
</div>

</body>
</html>
