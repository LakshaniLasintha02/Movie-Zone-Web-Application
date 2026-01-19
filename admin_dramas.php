<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// --- Add / Update / Delete logic ---

// Add Drama
if(isset($_POST['add_drama'])){
    $title = $_POST['title'];
    $releaseYear = $_POST['releaseYear'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $poster = "";
    if(!empty($_FILES['poster']['name'])){
        $targetDir = "img/d_" . strtolower(str_replace(" ", "_", $category)) . "/";
        if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $poster = $targetDir . basename($_FILES['poster']['name']);
        move_uploaded_file($_FILES['poster']['tmp_name'], $poster);
    }

    $stmt = $conn->prepare("INSERT INTO dramas (Title, ReleaseYear, Description, Poster, Category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $title, $releaseYear, $description, $poster, $category);
    $stmt->execute();
    header("Location: admin_dramas.php");
    exit();
}

// Update Drama
if(isset($_POST['update_drama'])){
    $id = $_POST['drama_id'];
    $title = $_POST['title'];
    $releaseYear = $_POST['releaseYear'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $posterQuery = "";
    if(!empty($_FILES['poster']['name'])){
        $targetDir = "img/d_" . strtolower(str_replace(" ", "_", $category)) . "/";
        if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $poster = $targetDir . basename($_FILES['poster']['name']);
        move_uploaded_file($_FILES['poster']['tmp_name'], $poster);
        $posterQuery = ", Poster='$poster'";
    }

    $conn->query("UPDATE dramas SET Title='$title', ReleaseYear='$releaseYear', Description='$description', Category='$category' $posterQuery WHERE DramaID=$id");
    header("Location: admin_dramas.php");
    exit();
}

// Delete Drama
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM dramas WHERE DramaID=$id");
    header("Location: admin_dramas.php");
    exit();
}

// Fetch Dramas
$result = $conn->query("SELECT * FROM dramas ORDER BY ReleaseYear DESC");

// Edit Drama
$editDrama = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $editDrama = $conn->query("SELECT * FROM dramas WHERE DramaID=$id")->fetch_assoc();
}

// Count total dramas
$totalDramas = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - Manage Dramas</title>
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
button, .edit-btn, .delete-btn, .card-btn {
    padding:8px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
    margin-right:5px;
    text-decoration:none;
}
button, .card-btn { background:#f44336; color:#fff; }
button:hover, .card-btn:hover { background:#d32f2f; }
.edit-btn { background:#2196f3; color:#fff; }
.edit-btn:hover { background:#1976d2; }
.delete-btn { background:#f44336; color:#fff; }
.delete-btn:hover { background:#d32f2f; }

/* Table */
table { width:100%; border-collapse: collapse; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
table th, table td { padding:12px 15px; text-align:center; }
table th { background:#f44336; color:#fff; font-weight:500; }
table tr:nth-child(even){ background:#f9f9f9; }
table tr:hover { background:#f1f1f1; }
img { max-width:80px; border-radius:6px; }

/* Modal */
.modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000; }
.modal-content { background:#fff; padding:30px; border-radius:12px; width:400px; max-width:90%; position:relative; box-shadow:0 8px 20px rgba(0,0,0,0.3); }
.modal-content h2 { margin-bottom:20px; color:#f44336; text-align:center; font-size:22px; }
.modal-content input, .modal-content textarea, .modal-content select { width:100%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:6px; font-size:14px; }
.modal-content button { width:100%; margin-top:15px; padding:10px; font-size:16px; border:none; border-radius:6px; cursor:pointer; background:#f44336; color:#fff; transition:0.3s; }
.modal-content button:hover { background:#d32f2f; }
.close { position:absolute; top:10px; right:15px; font-size:24px; font-weight:bold; cursor:pointer; color:#f44336; transition:0.3s; }
.close:hover { color:#d32f2f; }
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
    <h1>Manage Dramas</h1>

    <div class="cards">
        <div class="card">
            <h3>Total Dramas</h3>
            <p><?php echo $totalDramas; ?></p>
        </div>
    </div>

    <button id="addDramaBtn">+ Add New Drama</button>
    <br><br>

    <!-- Add/Edit Drama Modal -->
    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2><?php echo $editDrama ? "Edit Drama" : "Add Drama"; ?></h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="drama_id" value="<?php echo $editDrama['DramaID'] ?? ''; ?>">
                <input type="text" name="title" placeholder="Drama Title" value="<?php echo $editDrama['Title'] ?? ''; ?>" required>
                <input type="number" name="releaseYear" placeholder="Release Year" value="<?php echo $editDrama['ReleaseYear'] ?? ''; ?>" required>
                <textarea name="description" placeholder="Description" required><?php echo $editDrama['Description'] ?? ''; ?></textarea>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = ["Japanese","Thai","Indian","Sri Lankan","Chinese","Korean"];
                    foreach($categories as $cat){
                        $selected = ($editDrama && $editDrama['Category']==$cat) ? "selected" : "";
                        echo "<option value='$cat' $selected>$cat</option>";
                    }
                    ?>
                </select>
                <input type="file" name="poster" accept="image/*">
                <?php if($editDrama && $editDrama['Poster']): ?>
                    <p>Current Poster:</p>
                    <img src="<?php echo $editDrama['Poster']; ?>" alt="Poster" style="max-width:100px; margin-bottom:10px;">
                <?php endif; ?>
                <button type="submit" name="<?php echo $editDrama ? 'update_drama' : 'add_drama'; ?>">
                    <?php echo $editDrama ? "Update Drama" : "Add Drama"; ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Drama Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['DramaID']; ?></td>
            <td><?php if($row['Poster']) echo "<img src='{$row['Poster']}' alt='Poster'>"; ?></td>
            <td><?php echo htmlspecialchars($row['Title']); ?></td>
            <td><?php echo $row['ReleaseYear']; ?></td>
            <td><?php echo $row['Category']; ?></td>
            <td><?php echo htmlspecialchars(substr($row['Description'],0,100)); ?>...</td>
            <td>
                <a href="admin_dramas.php?edit=<?php echo $row['DramaID']; ?>" class="edit-btn">Edit</a><br><br>
                <a href="admin_dramas.php?delete=<?php echo $row['DramaID']; ?>" class="delete-btn" onclick="return confirm('Delete this drama?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<!-- Modal Script -->
<script>
var modal = document.getElementById("itemModal");
var addBtn = document.getElementById("addDramaBtn");
var closeBtn = document.getElementsByClassName("close")[0];
var form = modal.querySelector('form');
var submitBtn = modal.querySelector('button[type="submit"]');

// Open modal on Add New Drama
addBtn.onclick = function() {
    form.reset(); // clear all fields
    if(form.querySelector('input[name="drama_id"]')) {
        form.querySelector('input[name="drama_id"]').value = "";
    }
    modal.querySelector('h2').textContent = "Add Drama";
    submitBtn.name = "add_drama";
    submitBtn.textContent = "Add Drama";
    modal.style.display = "flex";
}

// Close modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if(event.target == modal) modal.style.display = "none";
}

// Open modal automatically if editing
<?php if($editDrama): ?>
modal.style.display = "flex";
modal.querySelector('h2').textContent = "Edit Drama";
form.querySelector('input[name="drama_id"]').value = "<?php echo $editDrama['DramaID']; ?>";
form.querySelector('input[name="title"]').value = "<?php echo addslashes($editDrama['Title']); ?>";
form.querySelector('input[name="releaseYear"]').value = "<?php echo $editDrama['ReleaseYear']; ?>";
form.querySelector('textarea[name="description"]').value = "<?php echo addslashes($editDrama['Description']); ?>";
form.querySelector('select[name="category"]').value = "<?php echo $editDrama['Category']; ?>";
submitBtn.name = "update_drama";
submitBtn.textContent = "Update Drama";
<?php endif; ?>
</script>

</body>
</html>





