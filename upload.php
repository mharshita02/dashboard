<?php
require 'vendor/autoload.php';  // PhpSpreadsheet autoload

use PhpOffice\PhpSpreadsheet\IOFactory;

// MySQL connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == 0) {
    $fileTmpPath = $_FILES['excelFile']['tmp_name'];

    $spreadsheet = IOFactory::load($fileTmpPath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Loop through rows and insert into database
    // Assuming first row is header, start from second row i=1
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];

        // Extract data according to your table structure
        $date = $conn->real_escape_string($row[0]);
        $saleOrderNumber = $conn->real_escape_string($row[1]);
        $invoiceNumber = $conn->real_escape_string($row[2]);
        $channelEntry = $conn->real_escape_string($row[3]);
        $productName = $conn->real_escape_string($row[4]);
        $productSkuCode = $conn->real_escape_string($row[5]);
        $qty = (int)$row[6];
        $unitPrice = (float)$row[7];
        $currency = $conn->real_escape_string($row[8]);
        $total = (float)$row[9];

        $sql = "INSERT INTO df_invoice_data (Date, Sale_Order_Number, Invoice_number, Channel_entry, Product_Name, Product_SKU_Code, Qty, Unit_Price, Currency, Total)
                VALUES ('$date', '$saleOrderNumber', '$invoiceNumber', '$channelEntry', '$productName', '$productSkuCode', $qty, $unitPrice, '$currency', $total)";
        $conn->query($sql);
    }

    echo "Data inserted successfully!";
} else {
    echo "No file uploaded or error in file upload.";
}

$conn->close();
?>
