<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid drama ID.");
}
$dramaID = intval($_GET['id']);

// Fetch drama info
$sql = "SELECT Dramas.Title, Dramas.ReleaseYear, Dramas.Description, Dramas.Poster,
               GROUP_CONCAT(Genres.GenreName SEPARATOR ', ') as Genres
        FROM Dramas
        LEFT JOIN DramaGenres ON Dramas.DramaID = DramaGenres.DramaID
        LEFT JOIN Genres ON DramaGenres.GenreID = Genres.GenreID
        WHERE Dramas.DramaID = ?
        GROUP BY Dramas.DramaID";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dramaID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Drama not found.");
}
$drama = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $drama['Title']; ?> - Drama Details</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .details-container {
      max-width: 900px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      display: flex;
      gap: 20px;
    }
    .details-container img {
      width: 300px;
      border-radius: 8px;
      object-fit: cover;
    }
    .details-info {
      flex: 1;
    }
    .details-info h2 {
      margin: 0 0 10px;
      font-size: 26px;
      color: #333;
    }
    .details-info p {
      margin: 6px 0;
      font-size: 16px;
      color: #555;
    }
    .back-link {
      display: block;
      margin: 20px auto;
      text-align: center;
      text-decoration: none;
      background: #f44336;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      transition: background 0.3s;
      width: fit-content;
    }
    .back-link:hover {
      background: #d32f2f;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="details-container">
  <img src="img/<?php echo $drama['Poster']; ?>" alt="<?php echo $drama['Title']; ?>">
  <div class="details-info">
    <h2><?php echo $drama['Title']; ?></h2>
    <p><strong>Release Year:</strong> <?php echo $drama['ReleaseYear']; ?></p>
    <p><strong>Genres:</strong> <?php echo $drama['Genres']; ?></p>
    <p><strong>Description:</strong><br><?php echo nl2br($drama['Description']); ?></p>
  </div>
</div>

<a class="back-link" href="dramas.php">⬅ Back to Dramas</a>

</body>
</html>
