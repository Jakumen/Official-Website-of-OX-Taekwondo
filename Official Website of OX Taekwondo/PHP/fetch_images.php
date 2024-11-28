<?php
header('Content-Type: application/json');
include('database.php');
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Fetch the image URLs from the database
$query = "SELECT id, url FROM gallery_images";
$result = mysqli_query($conn, $query);

$images = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Add the full path to the image URL if it's not already absolute
    $image_url = $row['url'];

    // Ensure the URL stored in the database is correct (relative to the root of the server)
    // If your image URL stored in the database is just 'uploads/armshin.png', use it directly.
    // No need to add '../' unless your images are in a subdirectory.
    if (strpos($image_url, '../uploads/') === false) {
        // If the image URL does not contain 'uploads/', prepend 'uploads/'
        $image_url = '../uploads/' . $image_url;
    }

    // Log the full URL for debugging
    error_log("Image URL: " . $image_url); // This will log the image URL to your server's error log

    // Push the image data into the array
    $images[] = [
        'id' => $row['id'],
        'url' => $image_url
    ];
}

// Return the image data as a JSON response
echo json_encode(['images' => $images]);

// Close the connection
mysqli_close($conn);
?>
