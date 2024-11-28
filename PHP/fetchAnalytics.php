<?php
header('Content-Type: application/json');

// Include the database connection setup
include('database.php');
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
// Get the current month and year
$currentMonth = date('Y-m');

// Fetch the number of users enrolled in the current month with completed payment
$query = "SELECT COUNT(id) AS numberOfUsers FROM pending_registrations WHERE DATE_FORMAT(dateEnrolled, '%Y-%m') = '$currentMonth' AND status = 'completed'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$numberOfUsers = $row['numberOfUsers'];

// Fetch recent activities (example: latest 5 logins)
$recentActivitiesQuery = "SELECT activity FROM activities ORDER BY activity_date DESC LIMIT 5";
$recentActivitiesResult = mysqli_query($conn, $recentActivitiesQuery);
$recentActivities = [];
while ($row = mysqli_fetch_assoc($recentActivitiesResult)) {
    $recentActivities[] = $row['activity'];
}

$response = [
    'total_users' => $numberOfUsers,
    'recent_activities' => $recentActivities
];

echo json_encode($response);
?>
