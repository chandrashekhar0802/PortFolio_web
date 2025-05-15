<?php
session_start();
require_once('../components/db.php');

// Protect the admin page
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = $_POST['url'];

    // Upload image
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $uploadPath = '../uploads/' . $imageName;

    if (move_uploaded_file($tmpName, $uploadPath)) {
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image, url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $imageName, $url]);
        $message = "✅ Project added successfully!";
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Project - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Top-right Home button -->
<div style="position: absolute; top: 20px; right: 20px;">
  <a href="../index.php" class="btn btn-outline-primary">🏠 Home</a>
</div>

<div class="container mt-5">
  <h2 class="mb-4">➕ Add New Project</h2>

  <?php if ($message): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="card p-4 shadow">
    <div class="mb-3">
      <label>Project Title</label>
      <input type="text" name="title" class="form-control" required />
    </div>

    <div class="mb-3">
      <label>Project Description</label>
      <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label>Project Image</label>
      <input type="file" name="image" class="form-control" accept="image/*" required />
    </div>

    <div class="mb-3">
      <label>Project Link (Live URL)</label>
      <input type="url" name="project_link" class="form-control" placeholder="https://yourproject.com" required />
    </div>

    <button type="submit" class="btn btn-success">Add Project</button>
    <a href="admin_panel.php" class="btn btn-secondary">⬅ Back to Panel</a>
  </form>
</div>

</body>
</html>
