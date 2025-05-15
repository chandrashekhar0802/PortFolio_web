<?php
session_start();
require_once('components/db.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = md5($_POST["password"]); // Assuming password in DB is stored as md5

    // Fetch user with matching email and password
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->execute([
        ':email' => $email,
        ':password' => $password
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["name"],
            "email" => $user["email"],
            "role" => $user["role"]
        ];

        // Role-based redirection
        if ($user["role"] === "admin") {
            header("Location: admin/admin_panel.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $errors[] = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Top-right Home button -->
<div style="position: absolute; top: 20px; right: 20px;">
  <a href="index.php" class="btn btn-outline-primary">🏠 Home</a>
</div>

<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" name="login" class="btn btn-success">Login</button>
        <a href="register.php" class="btn btn-link">Create a new account</a>
    </form>
</div>

</body>
</html>
