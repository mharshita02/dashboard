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
    $payment_number = $conn->real_escape_string($row["Payment Number"]);
    $invoice_number = $conn->real_escape_string($row["Invoice Number"]);
    $invoice_date = $conn->real_escape_string($row["Invoice Date"]);
    $transaction_type = $conn->real_escape_string($row["Transaction type"]);
    $transaction_desc = $conn->real_escape_string($row["Transaction Description"]);
    $invoice_amount = $conn->real_escape_string($row["Invoice Amount"]);
    $amount_paid = $conn->real_escape_string($row["Amount Paid"]);

    $sql = "INSERT INTO remittance_data 
            (payment_number, invoice_number, invoice_date, transaction_type, transaction_description, invoice_amount, amount_paid) 
            VALUES 
            ('$payment_number', '$invoice_number', '$invoice_date', '$transaction_type', '$transaction_desc', '$invoice_amount', '$amount_paid')";

    $conn->query($sql);
}

$conn->close();
echo "Data inserted successfully.";
?>
