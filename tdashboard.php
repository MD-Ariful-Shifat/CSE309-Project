<?php
// Include database connection
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - IUBQuiz Hub</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f6fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .topbar {
            background-color: #ffffff;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-card {
            border-radius: 15px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        .course-card {
            border-radius: 15px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4">IUBQuiz Hub</h4>
        <a href="home.php">Home</a>
        <a href="createquiz.php">Create Quiz</a>
        <a href="viewleaderboard.php">View Student Performance</a>
        <a href="giveannouncement.php">Post Announcement</a>
        <a href="updateqb.php">Update Question Bank</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h5>Welcome, Teacher!</h5>
                <p class="text-muted">Your personalized quiz management hub.</p>
            </div>
            <img src="img/quizhub.jpg" alt="Logo" style="height: 50px;">
        </div>

        <!-- Stat Cards -->
        <div class="row mt-4 g-3">
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Quizzes Created</h6>
                    <h3>5</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Quizzes Managed</h6>
                    <h3>3</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Announcements Posted</h6>
                    <h3>2</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Students Monitored</h6>
                    <h3>30</h3>
                </div>
            </div>
        </div>

        <!-- Course Cards (Available Quizzes) -->
        <div class="row mt-5 g-4">
            <h2 class="mb-4">Available Quizzes</h2>
            <div class="col-md-4">
                <div class="course-card">
                    <h6>Math Quiz 101</h6>
                    <p class="text-muted">A beginner-level quiz on basic math concepts.</p>
                    <a href="quiz.php?id=1" class="btn btn-sm btn-primary">Start Quiz</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card">
                    <h6>Science Quiz 101</h6>
                    <p class="text-muted">A basic quiz on introductory science concepts.</p>
                    <a href="quiz.php?id=2" class="btn btn-sm btn-primary">Start Quiz</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card">
                    <h6>History Quiz 101</h6>
                    <p class="text-muted">A quiz focusing on key events in world history.</p>
                    <a href="quiz.php?id=3" class="btn btn-sm btn-primary">Start Quiz</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
