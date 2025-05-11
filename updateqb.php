<?php
// Create the upload folder if it doesn't exist
$uploadDir = 'question_pdfs/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfFile'])) {
    $fileName = basename($_FILES['pdfFile']['name']);
    $targetPath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

    if ($fileType === 'pdf') {
        if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $targetPath)) {
            $uploadMessage = "PDF uploaded successfully!";
        } else {
            $uploadMessage = "Failed to upload PDF.";
        }
    } else {
        $uploadMessage = "Only PDF files are allowed.";
    }
}

// Handle file deletion
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $fileToDelete = $_GET['delete'];
    $filePath = $uploadDir . $fileToDelete;

    if (file_exists($filePath)) {
        unlink($filePath); // Delete the file
        $uploadMessage = "PDF deleted successfully!";
    } else {
        $uploadMessage = "File not found!";
    }
}

// List uploaded files
$pdfFiles = array_filter(scandir($uploadDir), function ($file) use ($uploadDir) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Question Bank</title>
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
    <h2 class="text-center">Update Question Bank (Upload PDF)</h2>

    <?php if (!empty($uploadMessage)): ?>
        <div class="alert alert-info"><?php echo $uploadMessage; ?></div>
    <?php endif; ?>

    <form action="updateqb.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="pdfFile" class="form-label">Upload PDF File</label>
            <input type="file" class="form-control" id="pdfFile" name="pdfFile" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload PDF</button>
    </form>

    <hr class="my-4">

    <h4 class="mb-3">Uploaded Question PDFs</h4>
    <?php if (!empty($pdfFiles)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>View</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pdfFiles as $file): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($file); ?></td>
                        <td><a href="<?php echo $uploadDir . $file; ?>" target="_blank" class="btn btn-sm btn-primary">View</a></td>
                        <td><a href="<?php echo $uploadDir . $file; ?>" download class="btn btn-sm btn-success">Download</a></td>
                        <td>
                            <a href="updateqb.php?delete=<?php echo urlencode($file); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No PDFs uploaded yet.</p>
    <?php endif; ?>
</div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 IUBQuiz Hub. All rights reserved.</p>
        <p>Designed and developed by Md. Ariful Shifat.</p>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
