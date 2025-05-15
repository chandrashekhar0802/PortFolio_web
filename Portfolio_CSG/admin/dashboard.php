<?php
include '../components/db.php';
include '../components/auth.php';
require_admin(); // Only admins can access

// Fetch messages and projects
$messages = $conn->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$projects = $conn->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Back to Website</a>
        <span class="navbar-text text-white">Admin Panel</span>
    </div>
</nav>

<div class="container mt-4">
    <h2>Project Management</h2>
    <a href="add_project.php" class="btn btn-primary mb-3">Add New Project</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Title</th><th>Description</th><th>Image</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project['title']) ?></td>
                <td><?= htmlspecialchars(substr($project['description'], 0, 50)) ?>...</td>
                <td>
                    <?php if ($project['image']): ?>
                        <img src="../uploads/<?= $project['image'] ?>" width="60" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="delete_project.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this project?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-5">Contact Messages</h2>
    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th></tr>
        </thead>
        <tbody>
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td><?= htmlspecialchars($msg['email']) ?></td>
                <td><?= htmlspecialchars($msg['subject']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
