<?php
// List uploaded files
$uploadDir = 'question_pdfs/';
$pdfFiles = array_filter(scandir($uploadDir), function ($file) use ($uploadDir) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Bank</title>
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
                    <li class="nav-item"><a class="nav-link" href="sdashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content container py-5">
        <h2 class="text-center">Question Bank</h2>

        <div class="list-group mt-4">
            <?php if (!empty($pdfFiles)): ?>
                <?php foreach ($pdfFiles as $file): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><?php echo htmlspecialchars($file); ?></h5>
                        </div>
                        <div>
                            <a href="<?php echo $uploadDir . $file; ?>" target="_blank" class="btn btn-sm btn-primary me-2">View</a>
                            <a href="<?php echo $uploadDir . $file; ?>" download class="btn btn-sm btn-success">Download</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No PDFs uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
