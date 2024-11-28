<?php
include("database.php");
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

$selectedSlots = $_POST['selectedSlots'];

$query = "INSERT INTO pending_schedules (slots, status) VALUES (?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selectedSlots);

if ($stmt->execute()) {
    header("Location: ../public/typeofpayment.html");
    exit();
} else {
    echo "Failed to save the schedule.";
}

$stmt->close();
$conn->close();
?>
