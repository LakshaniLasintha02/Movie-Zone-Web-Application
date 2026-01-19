<?php
// movie_details.php
include('db_connection.php'); // Your database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<h2>No movie selected</h2>";
    exit;
}

$movie_id = $_GET['id'];

// Fetch movie details
$query = "SELECT * FROM Movies WHERE MovieID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<h2>Movie not found</h2>";
    exit;
}

$movie = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $movie['Title']; ?> - Movie Details</title>
    <link rel="stylesheet" href="style.css"> <!-- Your project CSS -->
    <style>
     .details-container {
    display: flex;
    gap: 40px;
    padding: 50px;
}

.details-image img {
    width: 400px;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.details-info {
    max-width: 600px;
}

.details-info h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.details-info p {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    background-color: #ff4c4c;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    margin-top: 20px;
}

.btn:hover {
    background-color: #e04343;
}
</style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include('navbar.php'); ?>

    <div class="details-container">
        <div class="details-image">
            <img src="uploads/<?php echo $movie['Image']; ?>" alt="<?php echo $movie['Title']; ?>">
        </div>
        <div class="details-info">
            <h1><?php echo $movie['Title']; ?></h1>
            <p><strong>Genre:</strong> <?php echo $movie['Genre']; ?></p>
            <p><strong>Release Date:</strong> <?php echo $movie['ReleaseDate']; ?></p>
            <p><strong>Duration:</strong> <?php echo $movie['Duration']; ?> mins</p>
            <p><strong>Description:</strong><br><?php echo nl2br($movie['Description']); ?></p>
            <a href="buy_movie.php?id=<?php echo $movie['MovieID']; ?>" class="btn">Buy / Watch</a>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
