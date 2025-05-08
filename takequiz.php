<?php
// Include database connection
include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($quiz['quiz_title']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center"><?php echo htmlspecialchars($quiz['quiz_title']); ?></h2>
        <p class="text-center"><?php echo htmlspecialchars($quiz['quiz_description']); ?></p>

        <form method="post" action="submitquiz.php">
            <?php if ($questions_result->num_rows > 0): ?>
                <?php while ($row = $questions_result->fetch_assoc()): ?>
                    <div class="mb-3">
                        <label class="form-label"><?php echo htmlspecialchars($row['question_text']); ?></label>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="1"> Option 1<br>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="2"> Option 2<br>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="3"> Option 3<br>
                        <input type="radio" name="question_<?php echo $row['id']; ?>" value="4"> Option 4<br>
                    </div>
                <?php endwhile; ?>
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
            <?php else: ?>
                <p>No questions available for this quiz.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
