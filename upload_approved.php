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
    $asin = $conn->real_escape_string($row["ASIN"]);
    $gross_gms = $conn->real_escape_string($row["Gross Ship GMS"]);
    $net_gms = $conn->real_escape_string($row["Net Ship GMS"]);
    $order_date = $conn->real_escape_string($row["Order Date"]);
    $net_units = $conn->real_escape_string($row["Net Ship Units"]);
    $duration = $conn->real_escape_string($row["Duration"]);
    $net_net_served = $conn->real_escape_string($row["Net/Net\tNet Served"]); // Clean key name if needed
    $net_served = $conn->real_escape_string($row["Net Served"]);
    $coop = $conn->real_escape_string($row["COOP"]);
    $final_coop = $conn->real_escape_string($row["Final COOP"]);

    $sql = "INSERT INTO return_data 
            (asin, gross_ship_gms, net_ship_gms, order_date, net_ship_units, duration, net_net_served, net_served, coop, final_coop) 
            VALUES 
            ('$asin', '$gross_gms', '$net_gms', '$order_date', '$net_units', '$duration', '$net_net_served', '$net_served', '$coop', '$final_coop')";

    $conn->query($sql);
}

$conn->close();
echo "Data inserted successfully.";
?>
