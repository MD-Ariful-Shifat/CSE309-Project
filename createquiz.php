<?php
include 'connect.php';
session_start();

// Only allow logged-in teachers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];
$error = "";


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $quizTitle = $_POST['quizTitle'];
    
    $questions = $_POST['questions'];
    $answers = $_POST['answers'];
    $types = $_POST['types'];
    $options = $_POST['options'];

    if (empty($quizTitle) || empty($questions) || empty($answers)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO quizzes (quiz_title, teacher_id) VALUES (?, ?)");
        $stmt->bind_param("si", $quizTitle, $teacher_id);


        if ($stmt->execute()) {
            $quiz_id = $stmt->insert_id;

            $qStmt = $conn->prepare("INSERT INTO questions (quiz_id, question_text, answer_text, question_type, option_a, option_b, option_c, option_d) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            foreach ($questions as $index => $question) {
                $question_text = trim($question);
                $answer = trim($answers[$index]);
                $type = trim($types[$index]);

                $optA = $optB = $optC = $optD = null;
                if ($type === "MCQ" && isset($options[$index])) {
                    $optA = $options[$index]['a'] ?? null;
                    $optB = $options[$index]['b'] ?? null;
                    $optC = $options[$index]['c'] ?? null;
                    $optD = $options[$index]['d'] ?? null;
                }

                $qStmt->bind_param("isssssss", $quiz_id, $question_text, $answer, $type, $optA, $optB, $optC, $optD);
                $qStmt->execute();
            }

            header("Location: take_quiz.php?quiz_id=" . urlencode($quiz_id));
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home.php">IUBQuiz Hub</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="tdashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Create a New Quiz</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Quiz Title</label>
            <input type="text" class="form-control" name="quizTitle" required>
        </div>



        <div id="questions-container">
            <div class="question-block mb-4 border p-3 rounded">
                <label>Question</label>
                <input type="text" class="form-control" name="questions[]" required>

                <label class="mt-2">Question Type</label>
                <select class="form-select type-select" name="types[]" onchange="toggleOptions(this)">
                    <option value="MCQ">MCQ</option>
                    <option value="TrueFalse">True/False</option>
                </select>

                <div class="mcq-options mt-3">
                    <label>Option A</label>
                    <input type="text" class="form-control" name="options[0][a]">
                    <label>Option B</label>
                    <input type="text" class="form-control" name="options[0][b]">
                    <label>Option C</label>
                    <input type="text" class="form-control" name="options[0][c]">
                    <label>Option D</label>
                    <input type="text" class="form-control" name="options[0][d]">
                </div>

                <label class="mt-3">Correct Answer</label>
                <input type="text" class="form-control" name="answers[]" placeholder="e.g., A or True" required>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" onclick="addQuestion()">Add Question</button>
        <button type="submit" class="btn btn-primary mt-3">Create Quiz</button>
    </form>
</div>

<script>
    let questionIndex = 1;

    function addQuestion() {
        const container = document.getElementById('questions-container');
        const div = document.createElement('div');
        div.classList.add('question-block', 'mb-4', 'border', 'p-3', 'rounded');

        div.innerHTML = `
            <label>Question</label>
            <input type="text" class="form-control" name="questions[]" required>

            <label class="mt-2">Question Type</label>
            <select class="form-select type-select" name="types[]" onchange="toggleOptions(this)">
                <option value="MCQ">MCQ</option>
                <option value="TrueFalse">True/False</option>
            </select>

            <div class="mcq-options mt-3">
                <label>Option A</label>
                <input type="text" class="form-control" name="options[${questionIndex}][a]">
                <label>Option B</label>
                <input type="text" class="form-control" name="options[${questionIndex}][b]">
                <label>Option C</label>
                <input type="text" class="form-control" name="options[${questionIndex}][c]">
                <label>Option D</label>
                <input type="text" class="form-control" name="options[${questionIndex}][d]">
            </div>

            <label class="mt-3">Correct Answer</label>
            <input type="text" class="form-control" name="answers[]" placeholder="e.g., A or True" required>
        `;

        container.appendChild(div);
        questionIndex++;
    }

    function toggleOptions(select) {
        const parent = select.closest('.question-block');
        const optionsDiv = parent.querySelector('.mcq-options');
        optionsDiv.style.display = (select.value === "MCQ") ? "block" : "none";
    }

    // Initially hide options for non-MCQ questions
    document.addEventListener("DOMContentLoaded", function () {
        const selects = document.querySelectorAll('.type-select');
        selects.forEach(select => toggleOptions(select));
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
