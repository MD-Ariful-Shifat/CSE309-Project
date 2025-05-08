<?php
// Include database connection
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="home.php">IUB Quiz Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header class="text-center py-5 bg-light">
        <img src="img/quizhub.jpg" alt="IUB Quiz Hub Logo" class="img-fluid" style="max-width: 200px;">
        <h1>Welcome to IUB Quiz Hub</h1>
        <p>Your one-stop solution for all your quiz management needs.</p>
    </header>

    <!-- Optional: dynamic content like recent announcements -->
    <!--
    <div class="container my-4">
        <h3 class="text-center">Recent Announcements</h3>
        <ul class="list-group">
        <?php
        // Example: fetch announcements
        // $result = $conn->query("SELECT title FROM announcements ORDER BY created_at DESC LIMIT 5");
        // while ($row = $result->fetch_assoc()) {
        //     echo "<li class='list-group-item'>" . htmlspecialchars($row['title']) . "</li>";
        // }
        ?>
        </ul>
    </div>
    -->
    
    <footer>
        <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
        <p>Designed and developed by your team.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
