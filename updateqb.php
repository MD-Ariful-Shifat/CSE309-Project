<?php
// Include database connection
include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Question Bank</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

    <!-- Main Content -->
    <div class="content container mt-5">
        <h2 class="text-center">Update Question Bank</h2>
        <form action="updateqb.php" method="POST">
            <div class="mb-3">
                <label for="questionTitle" class="form-label">Question Title</label>
                <input type="text" class="form-control" id="questionTitle" name="questionTitle" placeholder="Enter the title of the question" required>
            </div>
            <div class="mb-3">
                <label for="questionContent" class="form-label">Question</label>
                <textarea class="form-control" id="questionContent" name="questionContent" rows="4" placeholder="Write the question" required></textarea>
            </div>
            <div class="mb-3">
                <label for="questionAnswer" class="form-label">Answer</label>
                <input type="text" class="form-control" id="questionAnswer" name="questionAnswer" placeholder="Enter the correct answer" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Question Bank</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
        <p>Designed and developed by your team.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
