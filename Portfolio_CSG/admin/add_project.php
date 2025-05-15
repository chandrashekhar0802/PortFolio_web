<?php
include '../components/db.php';
include '../components/auth.php';
require_admin(); // Only admin can access

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $imageName = '';
    $url = $_POST['url'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = '../uploads/' . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    }

    if ($title && $description) {
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image, url) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$title, $description, $imageName, $url])) {
            $success = "Project added successfully!";
        } else {
            $error = "Failed to add project.";
        }
    } else {
        $error = "Please fill all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2>Add New Project</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label>Project Title</label>
            <input type="text" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label>Project Image (optional)</label>
            <input type="file" name="image" class="form-control" />
        </div>
        <div class="mb-3">
      <label>Project URL (Live Link)</label>
      <input type="url" name="url" class="form-control" placeholder="https://example.com" required />
    </div>
        <button class="btn btn-success">Add Project</button>
    </form>
</div>

</body>
</html>
