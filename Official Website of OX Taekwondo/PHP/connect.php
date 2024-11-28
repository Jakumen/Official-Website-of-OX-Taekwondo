<?php
include("database.php");


$dateEnrolled = $_POST['dateEnrolled'];
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$middleInitial = $_POST['middleInitial'];
$suffix = $_POST['suffix'];
$houseNo = $_POST['houseNo'];
$street = $_POST['street'];
$barangay = $_POST['barangay'];
$province = $_POST['province'];
$city = $_POST['city'];
$cellNo = $_POST['cellNo'];
$email = $_POST['email'];
$birthDate = $_POST['birthDate'];
$religion = $_POST['religion'];
$sex = $_POST['sex'];
$statusSM = $_POST['status'];
$schoolName = $_POST['schoolName'];
$academicLevel = $_POST['academicLevel'];

$conn = new mysqli('localhost', 'root', '', 'oxtaekwondodb');

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Check if email already exists
$checkEmailQuery = "SELECT * FROM pending_registrations WHERE email = ?";
$checkStmt = $conn->prepare($checkEmailQuery);
if ($checkStmt === false) {
    die("Email Check Prepare failed: " . $conn->error);
}
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Email exists, show alert message
    echo "<script>alert('This email is already registered. Please enter a new email.'); window.history.back();</script>";
} else {
    // Prepare statement for insertion
    $sql = "INSERT INTO pending_registrations (dateEnrolled, lastName, firstName, middleInitial, suffix, houseNo, street, barangay, province, city, cellNo, email, birthDate, religion, sex, statusSM, schoolName, academicLevel, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Insert Prepare failed: " . $conn->error);
    }

    // Bind parameters - ensure count and types match
    $stmt->bind_param("sssssissssisssssss", $dateEnrolled, $lastName, $firstName, $middleInitial, $suffix, $houseNo, $street, $barangay, $province, $city, $cellNo, $email, $birthDate, $religion, $sex, $statusSM, $schoolName, $academicLevel);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    } else {
        echo "<script>alert('Record inserted successfully!'); window.location.href='../public/BeginnerClassSched.php';</script>";
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the email check statement and connection
$checkStmt->close();
$conn->close();
?>
