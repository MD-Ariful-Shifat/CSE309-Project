<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['announcementTitle'];
    $content = $_POST['announcementContent'];

    $stmt = $conn->prepare("INSERT INTO announcements (title, content, teacher_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $teacher_id);

    if ($stmt->execute()) {
        $success = "Announcement posted successfully!";
    } else {
        $error = "Failed to post announcement.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Give Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home.php">IUBQuiz Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="tdashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 content">
    <h2 class="text-center mb-4">Post an Announcement</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="announcementTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="announcementTitle" name="announcementTitle" required>
        </div>
        <div class="mb-3">
            <label for="announcementContent" class="form-label">Announcement</label>
            <textarea class="form-control" id="announcementContent" name="announcementContent" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Announcement</button>
    </form>

    <h4 class="mt-5">Your Announcements</h4>
    <?php
    $fetch = $conn->prepare("SELECT title, content, created_at FROM announcements WHERE teacher_id = ? ORDER BY created_at DESC");
    $fetch->bind_param("i", $teacher_id);
    $fetch->execute();
    $result = $fetch->get_result();

    while ($row = $result->fetch_assoc()):
    ?>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                <small class="text-muted">Posted on <?= $row['created_at'] ?></small>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
