<?php
include 'connect.php';
session_start();

// Only allow logged-in students
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Ensure quiz_id is passed
// if (!isset($_GET['quiz_id'])) {
   // echo "Quiz ID is missing.";
   // exit();
}
// $quiz_id = intval($_GET['quiz_id']);

// Fetch quiz
$quiz_stmt = $conn->prepare("SELECT * FROM quizzes WHERE id = ?");
$quiz_stmt->bind_param("i", $quiz_id);
$quiz_stmt->execute();
$quiz_result = $quiz_stmt->get_result();
$quiz = $quiz_result->fetch_assoc();

if (!$quiz) {
    echo "Quiz not found.";
    exit();
}

// Fetch questions
$question_stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$question_stmt->bind_param("i", $quiz_id);
$question_stmt->execute();
$questions_result = $question_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($quiz['quiz_title']); ?> - Take Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-3"><?php echo htmlspecialchars($quiz['quiz_title']); ?></h2>
    <p class="text-center text-muted"><?php echo htmlspecialchars($quiz['description']); ?></p>

    <!-- ✅ FORM to submit to submit_quiz.php -->
    <form action="submit_quiz.php" method="POST">
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

        <?php while ($row = $questions_result->fetch_assoc()): ?>
            <div class="mb-4">
                <label class="form-label fw-bold"><?php echo htmlspecialchars($row['question_text']); ?></label>

                <?php if ($row['question_type'] === 'MCQ'): ?>
                    <?php foreach (['A', 'B', 'C', 'D'] as $option): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?php echo $row['id']; ?>]" value="<?php echo $option; ?>" required>
                            <label class="form-check-label">
                                <?php echo htmlspecialchars($row["option_$option"]); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                <?php elseif ($row['question_type'] === 'TrueFalse'): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $row['id']; ?>]" value="True" required>
                        <label class="form-check-label">True</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $row['id']; ?>]" value="False">
                        <label class="form-check-label">False</label>
                    </div>

                <?php else: ?>
                    <input type="text" class="form-control" name="answers[<?php echo $row['id']; ?>]" placeholder="Enter your answer" required>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

        <button type="submit" class="btn btn-success">Submit Quiz</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
