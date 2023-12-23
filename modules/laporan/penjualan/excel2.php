<?php
// Include necessary files and establish a database connection
include_once('config.php');
include('../../../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$id_akun = $_GET['id_akun'];

// Create a new Excel spreadsheet
$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

//Ambil Nama Akun
$queryAkun = "SELECT ha.id_akun, akun.nama_akun
                FROM history_akun ha
                INNER JOIN akun ON akun.id_akun = ha.id_akun
                WHERE ha.id_akun = $id_akun LIMIT 1;";
$resultAkun = $db->query($queryAkun);
$rowAkun = $resultAkun->fetch_assoc();
$nama_akun = $rowAkun['nama_akun'];


// Output data from each row to Excel
$rowIndex = 1;
// Define the row index for the second merged cell
$rowIndex2 = 2;

// Define the range to merge (from column A to column E) for the cell
$mergeRange = "A{$rowIndex}:E{$rowIndex}";
// Define the range to merge (from column A to column E) for the second cell
$mergeRange2 = "A{$rowIndex2}:E{$rowIndex2}";

// Set the value for the merged cell
$activeWorksheet->setCellValue('A' . $rowIndex, "KAS BESAR " . $nama_akun);
// Set the value for the second merged cell
$activeWorksheet->setCellValue('A' . $rowIndex2, "PENJUALAN");

// Merge the cells in the defined range
$activeWorksheet->mergeCells($mergeRange);

// Merge the cells in the second defined range
$activeWorksheet->mergeCells($mergeRange2);

// Get the cell's style and alignment for the merged range
$cellStyle = $activeWorksheet->getStyle($mergeRange);
$alignment = $cellStyle->getAlignment();

// Set horizontal and vertical alignment for the merged range
$alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);
$alignment->setVertical(Alignment::VERTICAL_CENTER);

// Get the cell's style and alignment for the second merged range
$cellStyle2 = $activeWorksheet->getStyle($mergeRange2);
$alignment2 = $cellStyle2->getAlignment();

// Set horizontal and vertical alignment for the second merged range
$alignment2->setHorizontal(Alignment::HORIZONTAL_CENTER);
$alignment2->setVertical(Alignment::VERTICAL_CENTER);

// Calculate the number of columns
$columnCount = count(range('A', 'E')); // Assuming you have columns A to E

// Set the headers for the next row
$headerRowIndex = 3;
$activeWorksheet->setCellValue('A' . $headerRowIndex, "Tanggal");
$activeWorksheet->setCellValue('B' . $headerRowIndex, "Modal");
$activeWorksheet->setCellValue('C' . $headerRowIndex, "Pendapatan");
$activeWorksheet->setCellValue('D' . $headerRowIndex, "Omset");
$activeWorksheet->setCellValue('E' . $headerRowIndex, "Keterangan");

// Get the cell's style and alignment for the merged range
$cellStyle3 = $activeWorksheet->getStyle($headerRowIndex);
$alignment3 = $cellStyle->getAlignment();

// Set horizontal and vertical alignment for the second merged range
$alignment3->setHorizontal(Alignment::HORIZONTAL_CENTER);

$rowData = 4;

//Ambil Data
$queryData = "SELECT
            history_akun.*,
            penjualan.no_faktur AS penjualan_no_faktur,
            akun.nama_akun,
            history_penjualan.pendapatan AS pendapatan_penjualan
            FROM
            history_akun
            LEFT JOIN
            penjualan ON history_akun.id_penjualan = penjualan.id_penjualan
            LEFT JOIN
            history_penjualan ON history_penjualan.id_penjualan = penjualan.id_penjualan
            LEFT JOIN
            akun ON history_akun.id_akun = akun.id_akun
            WHERE
            history_akun.id_akun = $id_akun
            AND penjualan.id_penjualan IS NOT NULL;
            ";



$resultData2 = $db->query($queryData);

// Initialize variables to store the total values.
$totalModal = 0;
$totalPendapatan = 0;
$totalOmset = 0;


while ($row = $resultData2->fetch_assoc()) {
     // Debug output
    
     // Set cell values in the Excel worksheet
    $modal = $row['debit'] - $row['pendapatan_penjualan'];
    
    // Add the current row's values to the totals.
    $totalModal += $modal;
    $totalPendapatan += $row['pendapatan_penjualan'];
    $totalOmset  += $row['debit'];

    $activeWorksheet->setCellValue('A' . $rowData, $row['tanggal']);
    $activeWorksheet->setCellValue('B' . $rowData, number_format($modal, 2, ',', '.'));
    $activeWorksheet->setCellValue('C' . $rowData, number_format($row['pendapatan_penjualan'], 2, ',', '.'));
    $activeWorksheet->setCellValue('D' . $rowData, number_format($row['debit'], 2, ',', '.'));
    $activeWorksheet->setCellValue('E' . $rowData,  $row['penjualan_no_faktur']);

    $rowData++;
}

    // Set the total values in the last row of the Excel sheet.
    $activeWorksheet->setCellValue('A' . $rowData, 'Total');
    $activeWorksheet->setCellValue('B' . $rowData, number_format($totalModal, 2, ',', '.'));
    $activeWorksheet->setCellValue('C' . $rowData, number_format($totalPendapatan, 2, ',', '.'));
    $activeWorksheet->setCellValue('D' . $rowData, number_format($totalOmset, 2, ',', '.'));
    

// Optionally, you can style the merged cell (e.g., applying borders)
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
];

// Auto-size columns
for ($col = 'A'; $col <= 'E'; $col++) {
    $activeWorksheet->getColumnDimension($col)->setAutoSize(true);
}

$activeWorksheet->getStyle('A1:E'.$rowData)->applyFromArray($styleArray);


// Set appropriate headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data.xlsx"');
header('Cache-Control: max-age=0');  // Prevent caching

// Output the Excel file to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Close the database connection
$connection->close();
?>
