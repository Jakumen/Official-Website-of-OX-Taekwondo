<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Official Website of OX Taekwondo/PHP/database.php");

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (!isset($_POST['plan'])) {
    die('Error: Plan is not set.');
}

$plan = $_POST['plan'];
$amount = 0;
$description = '';
if ($plan == 'monthly') {
    $amount = 200000; // PHP 2000.00 in centavos
    $description = 'Monthly';
} elseif ($plan == 'quarterly') {
    $amount = 500000; // PHP 5000.00 in centavos
    $description = 'Quarterly';
} elseif ($plan == 'yearly') {
    $amount = 1800000; // PHP 18000.00 in centavos
    $description = 'Yearly';
}

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/links",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'data' => [
        'attributes' => [
                'amount' => $amount,
                'description' => $description,
                'remarks' => 'Subscription'
        ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Basic c2tfdGVzdF9uWjJ6anlnSlBUU3pONFY3d0s3V21Cclg6",
    "content-type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $decoded = json_decode($response, true);
    
    echo "<pre>";
    print_r($decoded);
    echo "</pre>";
    
    if (isset($decoded['data']['attributes']['checkout_url'])) {
        $checkoutURL = $decoded['data']['attributes']['checkout_url'];
        
        // Update statuses to "completed" here upon successful payment
        $updateQueries = [
            "UPDATE pending_medcerts SET status='completed' WHERE status='pending'",
            "UPDATE pending_registrations SET status='completed' WHERE status='pending'",
            "UPDATE pending_schedules SET status='completed' WHERE status='pending'",
            "UPDATE pending_payments SET status='completed' WHERE status='pending'"
        ];
        
        foreach ($updateQueries as $query) {
            $conn->query($query);
        }
        
        // Insert completed records into complete_records table
        $transferQueries = [
            "INSERT INTO complete_records (SELECT * FROM pending_medcerts WHERE status='completed')",
            "INSERT INTO complete_records (SELECT * FROM pending_registrations WHERE status='completed')",
            "INSERT INTO complete_records (SELECT * FROM pending_schedules WHERE status='completed')",
            "INSERT INTO complete_records (SELECT * FROM pending_payments WHERE status='completed')"
        ];
        
        foreach ($transferQueries as $query) {
            $conn->query($query);
        }
        
        // Redirect to the checkout URL
        header("Location: $checkoutURL");
        exit();
    } else {
        echo "Failed to get the checkout URL from response.";
    }
}
?>
