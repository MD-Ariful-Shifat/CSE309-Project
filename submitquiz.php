<?php
include 'connect.php';
session_start();

// Only allow logged-in students
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Ensure quiz_id is passed
if (!isset($_POST['quiz_id'])) {
    echo "Quiz ID is missing.";
    exit();
}

$quiz_id = intval($_POST['quiz_id']);
$student_id = $_SESSION['user_id'];

// Fetch the correct answers for the quiz
$question_stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$question_stmt->bind_param("i", $quiz_id);
$question_stmt->execute();
$questions_result = $question_stmt->get_result();

$total_marks = 0;
$obtained_marks = 0;

// Loop through all the questions to evaluate the student's answers
while ($row = $questions_result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = $row['correct_answer'];  // Assuming you store the correct answer in the database

    // Check the student's answer
    if (isset($_POST['answers'][$question_id]) && $_POST['answers'][$question_id] === $correct_answer) {
        $obtained_marks++;
    }
}

// Calculate total marks
$total_marks = $questions_result->num_rows;  // Total number of questions

// Store the result in the database (optional)
$stmt = $conn->prepare("INSERT INTO quiz_results (student_id, quiz_id, obtained_marks, total_marks) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiii", $student_id, $quiz_id, $obtained_marks, $total_marks);
$stmt->execute();

// Display the result to the student
echo "<div class='container mt-5 text-center'>";
echo "<h3>Your Score for the Quiz</h3>";
echo "<p>You scored $obtained_marks out of $total_marks.</p>";

// Optionally, you can display a pass/fail message or any other logic based on the score
if ($obtained_marks === $total_marks) {
    echo "<p>Congratulations, you passed!</p>";
} else {
    echo "<p>Better luck next time!</p>";
}

echo "<a href='quiz_page.php?quiz_id=$quiz_id' class='btn btn-primary'>Take Quiz Again</a>";
echo "</div>";
?>
