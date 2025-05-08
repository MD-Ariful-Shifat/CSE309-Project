<?php
// Include database connection
include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<div class="container mt-5">
    <h2 class="text-center">Create a New Quiz</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="quizTitle" class="form-label">Quiz Title</label>
            <input type="text" class="form-control" name="quizTitle" id="quizTitle" required>
        </div>
        <div class="mb-3">
            <label for="quizDescription" class="form-label">Description</label>
            <textarea class="form-control" name="quizDescription" id="quizDescription" rows="3" required></textarea>
        </div>
        <div id="questions-container">
            <h4>Questions</h4>
            <div class="mb-3">
                <input type="text" class="form-control" name="questions[]" placeholder="Enter question" required>
                <input type="text" class="form-control mt-2" name="answers[]" placeholder="Enter answer" required>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="addQuestion()">Add Question</button>
        <button type="submit" class="btn btn-primary mt-3">Create Quiz</button>
    </form>
</div>

<script>
    function addQuestion() {
        const container = document.getElementById('questions-container');
        const questionDiv = document.createElement('div');
        questionDiv.classList.add('mb-3');
        questionDiv.innerHTML = `
            <input type="text" class="form-control" name="questions[]" placeholder="Enter question" required>
            <input type="text" class="form-control mt-2" name="answers[]" placeholder="Enter answer" required>
        `;
        container.appendChild(questionDiv);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

