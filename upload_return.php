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
    $return_date = $conn->real_escape_string($row["Return date"]);
    $shipment_request_id = $conn->real_escape_string($row["Shipment Request ID"]);
    $return_id = $conn->real_escape_string($row["Return ID"]);
    $marketplace = $conn->real_escape_string($row["Marketplace"]);
    $authorization_id = $conn->real_escape_string($row["Authorization ID"]);
    $vendor_code = $conn->real_escape_string($row["Vendor code"]);
    $invoice_number = $conn->real_escape_string($row["Invoice number"]);
    $warehouse = $conn->real_escape_string($row["Warehouse"]);
    $total_cost = $conn->real_escape_string($row["Total cost"]);

    $sql = "INSERT INTO return_data 
            (return_date, shipment_request_id, return_id, marketplace, authorization_id, vendor_code, invoice_number, warehouse, total_cost) 
            VALUES 
            ('$return_date', '$shipment_request_id', '$return_id', '$marketplace', '$authorization_id', '$vendor_code', '$invoice_number', '$warehouse', '$total_cost')";

    $conn->query($sql);
}

$conn->close();
echo "Data inserted successfully.";
?>
