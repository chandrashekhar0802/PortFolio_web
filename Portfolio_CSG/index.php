<?php
session_start();
include 'components/db.php';

// // Fetch projects from DB
// $stmt = $conn->prepare("SELECT * FROM projects ORDER BY id DESC");
// $stmt->execute();
// $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">CSG@</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Admin Panel</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white text-center py-5 mt-5">
        <h1>Welcome to My Portfolio</h1>
        <p>Browse some of my recent projects</p>
    </header>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5 mt-5">
        <div class="container">
            <h1>Hello, I'm Chandrashekhar</h1>
            <p class="lead">Computer Science graduate & aspiring web developer</p>
        </div>
    </header>


    <!-- <section class="container my-5">
    <div class="row">
        <?php foreach ($projects as $project): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <?php if (!empty($project['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($project['image']) ?>" class="card-img-top" alt="project image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($project['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section> -->

    <?php
    // Fetch all projects from the database
    $stmt = $conn->prepare("SELECT * FROM projects ORDER BY id DESC");
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Projects Section -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">My Projects</h2>
        <div class="row">
            <?php if (count($projects) > 0): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <!-- Project Image -->
                            <?php if (!empty($project['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($project['image']) ?>" class="card-img-top"
                                    alt="Project Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($project['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($project['description'], 0, 80)) ?>...</p>
                                <!-- Visit Button -->
                                <?php if (!empty($project['url'])): ?>
                                    <a href="<?= htmlspecialchars($project['url']) ?>" class="btn btn-primary"
                                        target="_blank">Visit</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No projects added yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-5 bg-light" id="technologies">
  <div class="container">
    <h2 class="text-center mb-4">Technologies & Tools</h2>
    <div class="row text-center">
      <!-- Language Cards -->
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML5" width="50">
          <p class="mt-2">HTML5</p>
        </div>
      </div>
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS3" width="50">
          <p class="mt-2">CSS3</p>
        </div>
      </div>
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" width="50">
          <p class="mt-2">JavaScript</p>
        </div>
      </div>
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" width="50">
          <p class="mt-2">PHP</p>
        </div>
      </div>
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" width="50">
          <p class="mt-2">MySQL</p>
        </div>
      </div>
      <div class="col-md-2 col-6 mb-4">
        <div class="card border-0 shadow-sm p-3">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" width="50">
          <p class="mt-2">Bootstrap</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ========== Knowledge & Skills Section ========== -->
<section class="py-5 bg-light" id="skills">
  <div class="container">
    <h2 class="text-center mb-5">My Development Skills</h2>

    <!-- Languages -->
    <div class="mb-5">
      <h4 class="mb-3">Languages I Know</h4>
      <div class="d-flex flex-wrap gap-3">
        <span class="badge bg-primary p-2 px-3 fs-6">JavaScript</span>
        <span class="badge bg-primary p-2 px-3 fs-6">pyhton</span>
        <span class="badge bg-primary p-2 px-3 fs-6">Java</span>
        <span class="badge bg-primary p-2 px-3 fs-6">PHP</span>
        <span class="badge bg-primary p-2 px-3 fs-6">SQL</span>
        <span class="badge bg-primary p-2 px-3 fs-6">HTML</span>
        <span class="badge bg-primary p-2 px-3 fs-6">CSS</span>
        <span class="badge bg-primary p-2 px-3 fs-6">MongoDB</span>
      </div>
    </div>

    <!-- Tools -->
    <div class="mb-5">
      <h4 class="mb-3">Technologies & Tools I’ve Worked With</h4>
      <div class="d-flex flex-wrap gap-3">
        <span class="badge bg-success p-2 px-3 fs-6">VS Code</span>
        <span class="badge bg-success p-2 px-3 fs-6">Sublime Text</span>
        <span class="badge bg-success p-2 px-3 fs-6">XAMPP</span>
        <span class="badge bg-success p-2 px-3 fs-6">phpMyAdmin</span>
        <span class="badge bg-success p-2 px-3 fs-6">Git & GitHub</span>
        <span class="badge bg-success p-2 px-3 fs-6">Chrome DevTools</span>
        <span class="badge bg-success p-2 px-3 fs-6">Netwroking</span>
        <span class="badge bg-success p-2 px-3 fs-6">operating Systems</span>
      </div>
    </div>

    <!-- Frameworks & Libraries -->
    <div class="mb-5">
      <h4 class="mb-3">Frameworks & Libraries I Use</h4>
      <div class="d-flex flex-wrap gap-3">
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">React.js</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Next.js</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">material/ui</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Font (Google Font,FontOwesome,Iconclub)</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Redux</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Tailwind CSS</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Bootstrap</span>
        <span class="badge bg-warning text-dark p-2 px-3 fs-6">Node.js (basic)</span>
      </div>
    </div>

    <!-- Services -->
    <div>
      <h4 class="mb-3">Services I Provide</h4>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">✅ Full Stack Web Development (MERN & PHP/MySQL)</li>
        <li class="list-group-item">✅ Frontend Development using React, Tailwind, Bootstrap</li>
        <li class="list-group-item">✅ Backend Development with PHP, Node.js (basic)</li>
        <li class="list-group-item">✅ Responsive UI Design & Layout</li>
        <li class="list-group-item">✅ Admin Panel & CRUD Functionality</li>
        <li class="list-group-item">✅ Portfolio & Business Website Setup</li>
      </ul>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
<div class="text-center mt-5">
  <a href="uploads/Resume.pdf" download class="btn btn-primary btn-lg">
    <i class="fas fa-download me-2"></i>Download My Resume
  </a>
</div>
</section>

    <footer class="bg-dark text-white text-center p-3">
        &copy; <?= date('Y') ?> Chandrashekhar Ghosh
    </footer>

</body>

</html>