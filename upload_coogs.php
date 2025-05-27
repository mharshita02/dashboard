<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data)) {
    echo "No data received.";
    exit;
}

foreach ($data as $row) {
    $invoice_id = $conn->real_escape_string($row["Invoice ID"]);
    $invoice_date = $conn->real_escape_string($row["Invoice date"]);
    $agreement_id = $conn->real_escape_string($row["Agreement ID"]);
    $agreement_title = $conn->real_escape_string($row["Agreement title"]);
    $funding_type = $conn->real_escape_string($row["Funding Type"]);
    $original_balance = $conn->real_escape_string($row["Original balance"]);

    $sql = "INSERT INTO coogs_data
            (invoice_id, invoice_date, agreement_id, agreement_title, funding_type, original_balance)
            VALUES
            ('$invoice_id', '$invoice_date', '$agreement_id', '$agreement_title', '$funding_type', '$original_balance')";

    $conn->query($sql);
}

$conn->close();
echo "Data inserted successfully.";
?>
