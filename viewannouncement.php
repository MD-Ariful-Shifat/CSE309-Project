<?php
include 'connect.php';

$result = $conn->query("SELECT * FROM announcements ORDER BY posted_on DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Announcements</title>
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
                <li class="nav-item"><a class="nav-link" href="sdashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5 content">
    <h2 class="text-center mb-4">Latest Announcements</h2>
    <div class="list-group">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="list-group-item">';
                echo '<h5>' . htmlspecialchars($row['title']) . '</h5>';
                echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '</p>';
                echo '<small class="text-muted">Posted on: ' . htmlspecialchars($row['posted_on']) . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">No announcements available.</p>';
        }
        ?>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
