<?php
include("database.php");
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

$paymentType = $_POST['paymentType'];
$amount = $_POST['amount'];

$query = "INSERT INTO pending_payments (paymentType, amount, status) VALUES (?, ?, 'pending')";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $paymentType, $amount);

if ($stmt->execute()) {
    // Redirect to PayMongo payment gateway or handle the next step
    header("Location: ../app/Http/Controllers/paymentController.php?plan=$paymentType");
    exit();
} else {
    echo "Failed to save the payment details.";
}

$stmt->close();
$conn->close();
?>
