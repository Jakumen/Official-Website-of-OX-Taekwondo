<?php
include("database.php");
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
// Define the upload directory
$uploadDir = 'uploads/';

// Check if the upload directory exists, if not create it
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['medical_certificate'])) {
    $fileName = $_FILES['medical_certificate']['name'];
    $fileTmpName = $_FILES['medical_certificate']['tmp_name'];
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpName, $filePath)) {
        $query = "INSERT INTO pending_medcerts (file_path, status) VALUES (?, 'pending')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $filePath);

        if ($stmt->execute()) {
            header("Location: ../public/Registration.php");
            exit();
        } else {
            echo "Failed to save the file.";
        }

        $stmt->close();
    } else {
        echo "Failed to upload the file.";
    }
} else {
    echo "No file uploaded.";
}
$conn->close();
?>
