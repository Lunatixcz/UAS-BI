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
$activeWorksheet->setCellValue('A' . $rowIndex2, "PEMASUKAN");

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
$activeWorksheet->setCellValue('B' . $headerRowIndex, "Debit");
$activeWorksheet->setCellValue('C' . $headerRowIndex, "Kredit");
$activeWorksheet->setCellValue('D' . $headerRowIndex, "Saldo");
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
                pembelian.no_faktur AS pembelian_no_faktur,
                penjualan.no_faktur AS penjualan_no_faktur,
                cash_keluar.bukti_keluar AS keluar_no_faktur,
                cash_masuk.bukti_masuk AS masuk_no_faktur,
                akun.nama_akun,
                history_penjualan.pendapatan AS pendapatan_penjualan
                FROM
                history_akun
                LEFT JOIN
                pembelian ON history_akun.id_pembelian = pembelian.id_pembelian
                LEFT JOIN
                penjualan ON history_akun.id_penjualan = penjualan.id_penjualan
                LEFT JOIN
                history_penjualan ON history_penjualan.id_penjualan = penjualan.id_penjualan
                LEFT JOIN
                akun ON history_akun.id_akun = akun.id_akun
                LEFT JOIN
                cash_keluar ON history_akun.id_ckeluar = cash_keluar.id_ckeluar
                LEFT JOIN
                cash_masuk ON history_akun.id_cmasuk = cash_masuk.id_cmasuk
                WHERE
                history_akun.id_akun = $id_akun;";



$resultData = $db->query($queryData);

// Initialize variables to store the total values.
$totalDebit = 0;
$totalKredit = 0;
$totalSaldo = 0;


// Initialize the running total for 'saldo'
$runningTotalSaldo = 0;

while ($row = $resultData->fetch_assoc()) {
    // Set cell values in the Excel worksheet
    $saldo = $row['debit']-$row['kredit'];
     
    if (!is_null($row['pembelian_no_faktur'])) {
      $keterangan = $row['pembelian_no_faktur'];
    }
    elseif(!is_null($row['penjualan_no_faktur'])){
       $keterangan = $row['penjualan_no_faktur'];
    }
    elseif(!is_null($row['keluar_no_faktur'])){
       $keterangan = $row['keluar_no_faktur'];
    }
    elseif(!is_null($row['masuk_no_faktur'])){
       $keterangan = $row['masuk_no_faktur'];
    }

    // Update the running total for 'saldo'
    $runningTotalSaldo += $saldo;
    // Add the current row's values to the totals.
    $totalDebit += $row['debit'];
    $totalKredit += $row['kredit'];
    $totalSaldo += $runningTotalSaldo;
    

    $activeWorksheet->setCellValue('A' . $rowData, $row['tanggal']);
    $activeWorksheet->setCellValue('B' . $rowData, number_format($row['debit'], 2, ',', '.'));
    $activeWorksheet->setCellValue('C' . $rowData, number_format($row['kredit'], 2, ',', '.'));
    $activeWorksheet->setCellValue('D' . $rowData, number_format($runningTotalSaldo, 2, ',', '.'));
    $activeWorksheet->setCellValue('E' . $rowData, $keterangan);

   $rowData++;
}

    // Set the total values in the last row of the Excel sheet.
    $activeWorksheet->setCellValue('A' . $rowData, 'Total');
    $activeWorksheet->setCellValue('B' . $rowData, number_format($totalDebit, 2, ',', '.'));
    $activeWorksheet->setCellValue('C' . $rowData, number_format($totalKredit, 2, ',', '.'));
    $activeWorksheet->setCellValue('D' . $rowData, number_format($totalSaldo, 2, ',', '.'));
    // $activeWorksheet->setCellValue('E' . $rowData, number_format($totalPendapatan, 2, ',', '.'));

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
ob_end_clean(); // Clear any previously sent output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data.xlsx"');
header('Cache-Control: max-age=0');  // Prevent caching

// Output the Excel file to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Close the database connection
$connection->close();
?>
