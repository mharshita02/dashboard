<?php
$host = 'localhost';
$db = 'dashboard';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["status" => "error", "message" => "Connection failed"]));
}

$totals = [];

$tables = [
    "df_invoice",
    "po_invoice",
    "remittance",
    "returns",
    "sale",
    "coogs"
];

foreach ($tables as $table) {
    $result = $conn->query("SELECT SUM(total) AS sum_total FROM $table");
    $row = $result->fetch_assoc();
    $totals[$table] = $row['sum_total'] ?? 0;
}

$conn->close();

echo json_encode(["status" => "success", "totals" => $totals]);
?>
