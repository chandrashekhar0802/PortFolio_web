<?php
include '../components/db.php';
include '../components/auth.php';
require_admin();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get image name
    $stmt = $conn->prepare("SELECT image FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete image file if exists
    if ($project && $project['image']) {
        $filePath = '../uploads/' . $project['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Delete project from DB
    $delStmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $delStmt->execute([$id]);
}

header("Location: dashboard.php");
exit;
