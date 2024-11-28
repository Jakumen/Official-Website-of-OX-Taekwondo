<?php
header('Content-Type: application/json');
include('database.php');
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check for a connection error
if (mysqli_connect_errno()) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Get the image ID from URL parameter instead of POST body
$imageId = isset($_GET['id']) ? $_GET['id'] : null;
if (!$imageId) {
    echo json_encode(['success' => false, 'message' => 'No image ID provided']);
    exit();
}

// Fetch the image URL from the database
$query = "SELECT url FROM gallery_images WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL query preparation failed']);
    exit();
}

mysqli_stmt_bind_param($stmt, 'i', $imageId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $imageUrl = $row['url'];
    $imagePath = '../uploads/' . $imageUrl; // Adjust the path as needed

    // Check if file exists and log the path
    if (!file_exists($imagePath)) {
        echo json_encode(['success' => false, 'message' => 'Image file not found: ' . $imagePath]);
        exit();
    }

    // Delete the image from the server
    if (!unlink($imagePath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to delete image file: ' . $imagePath]);
        exit();
    }

    // Delete the image record from the database
    $deleteQuery = "DELETE FROM gallery_images WHERE id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteQuery);
    if ($deleteStmt === false) {
        echo json_encode(['success' => false, 'message' => 'SQL query preparation for delete failed']);
        exit();
    }

    mysqli_stmt_bind_param($deleteStmt, 'i', $imageId);
    if (mysqli_stmt_execute($deleteStmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete image record from database']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Image not found in database']);
}

mysqli_close($conn);
?>
