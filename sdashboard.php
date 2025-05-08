<?php
// Include database connection
include 'connect.php';
// You should fetch the student's name from session or DB
// Example: $student['fullName'] = $_SESSION['student_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - IUBQuiz Hub</title>
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
        .progress-bar {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4">IUBQuiz Hub</h4>
        <a href="home.php">Home</a>
        <a href="takequiz.php">Take Quiz</a>
        <a href="viewresult.php">View Results</a>
        <a href="viewleaderboard.php">Leaderboard</a>
        <a href="viewannouncement.php">Announcements</a>
        <a href="viewqbank.php">Question Bank</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h5>Welcome, Student<?php echo htmlspecialchars($student['fullName'] ?? 'Student'); ?>!</h5>
                <p class="text-muted">Your personalized learning and quiz hub.</p>
            </div>
            <img src="img/quizhub.jpg" alt="Logo" style="height: 50px;">
        </div>

        <!-- Stat Cards -->
        <div class="row mt-4 g-3">
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Quizzes Taken</h6>
                    <h3>10</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Courses Completed</h6>
                    <h3>4</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>In Progress</h6>
                    <h3>1</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <h6>Points</h6>
                    <h3>0.01</h3>
                </div>
            </div>
        </div>

        <!-- Course Cards -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="course-card">
                    <h6>Full Stack Web Development Roadmap</h6>
                    <div class="progress my-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 0%;"></div>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary">Continue</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card">
                    <h6>Be a Pro Virtual Assistant</h6>
                    <div class="progress my-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 88%;"></div>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary">Continue</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card">
                    <h6>Creative Content Design Techniques</h6>
                    <div class="progress my-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 0%;"></div>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary">Continue</a>
                </div>
            </div>
        </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
