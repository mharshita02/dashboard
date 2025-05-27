<?php
$host = 'localhost';
$db = 'dashboard';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $row) {
    $date = $conn->real_escape_string($row['Date']);
    $sale_order = $conn->real_escape_string($row['Sale Order Number']);
    $invoice = $conn->real_escape_string($row['Invoice number']);
    $channel = $conn->real_escape_string($row['Channel entry']);
    $product = $conn->real_escape_string($row['Product Name']);
    $sku = $conn->real_escape_string($row['Product SKU Code']);
    $qty = $conn->real_escape_string($row['Qty']);
    $unit_price = $conn->real_escape_string($row['Unit Price']);
    $currency = $conn->real_escape_string($row['Currency']);
    $total = $conn->real_escape_string($row['Total']);

    $sql = "INSERT INTO df_invoice 
    (date, sale_order, invoice, channel, product_name, sku_code, qty, unit_price, currency, total) 
    VALUES ('$date', '$sale_order', '$invoice', '$channel', '$product', '$sku', '$qty', '$unit_price', '$currency', '$total')";

    $conn->query($sql);
}

$conn->close();
echo "Data inserted successfully";
?>
