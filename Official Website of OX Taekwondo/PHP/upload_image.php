<?php
header('Content-Type: application/json');
include('database.php');
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

$targetDir = "../uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$response = ['success' => false];

// Debugging logs
error_log("Target Directory: " . realpath($targetDir));
error_log("Target File: " . $targetFile);
error_log("File Type: " . $imageFileType);

// Check if image file is valid
if (getimagesize($_FILES["image"]["tmp_name"]) === false) {
    $response['message'] = "File is not an image.";
} elseif ($_FILES["image"]["size"] > 5000000) {
    $response['message'] = "File is too large.";
} elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    $response['message'] = "Only JPG, JPEG, PNG & GIF are allowed.";
} else {
    // Append a unique identifier to the file name
    $uniqueFileName = $targetDir . uniqid() . '_' . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uniqueFileName)) {
        $stmt = $conn->prepare("INSERT INTO gallery_images (url) VALUES (?)");
        $stmt->bind_param("s", $uniqueFileName);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['url'] = $uniqueFileName;
            $response['id'] = $stmt->insert_id;
        } else {
            $response['message'] = "Failed to insert into database.";
        }
        $stmt->close();
    } else {
        $response['message'] = "Error moving uploaded file.";
    }
}

echo json_encode($response);
$conn->close();
?>
