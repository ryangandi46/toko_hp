<?php
// memanggil library FPDF
require('fpdf184/fpdf.php');
include 'connection.php';

// $months = array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
// 			$year = date('Y');

// Ambil nilai bulan dan tahun dari URL
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'Legal');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 13);

$pdf->Cell(270, 10, 'MONTHLY REPORT - ' . date("F Y", mktime(0, 0, 0, $month, 1, $year)), 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(50, 7, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(30, 7, 'PEMBELI', 1, 0, 'C');
$pdf->Cell(50, 7, 'PHONE', 1, 0, 'C');
$pdf->Cell(30, 7, 'HARGA', 1, 0, 'C');
$pdf->Cell(15, 7, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(30, 7, 'TOTAL HARGA', 1, 0, 'C');
$pdf->Cell(30, 7, 'TUNAI', 1, 0, 'C');
$pdf->Cell(30, 7, 'PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(20, 7, 'STATUS', 1, 0, 'C');



$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$total_harga = 0;
$jumlahTerjual = 0;

$data = mysqli_query($db_connection, "SELECT * FROM transaksi INNER JOIN buyer ON transaksi.id_buyer = buyer.id_buyer INNER JOIN stock ON transaksi.id_stock = stock.id_stock
INNER JOIN users ON transaksi.userid = users.userid");

while ($d = mysqli_fetch_array($data)) {

  $pdf->Cell(10, 6, $no++, 1, 0, 'C');
  $pdf->Cell(50, 6, date('D, d-M-Y H:i:s', strtotime($d['tanggal'])), 1, 0);
  $pdf->Cell(30, 6, $d['name_buyer'], 1, 0);
  $pdf->Cell(50, 6, $d['phone'], 1, 0);
  $pdf->Cell(30, 6, $d['price'], 1, 0);
  $pdf->Cell(15, 6, $d['jumlah'], 1, 0);
  $pdf->Cell(30,6,'Rp ' .  number_format($d['total_harga'], 2, ',', '.'),1,0); // Format total harga
  $pdf->Cell(30,6,'Rp ' .  number_format($d['tunai'], 2, ',', '.'),1,0); // Format tunai
  $pdf->Cell(30, 6, $d['type_pembayaran'], 1, 0);
  $pdf->Cell(20, 6, $d['status'], 1, 1);

  // Hitung total harga
  //  $total_harga = $total_harga + $d['total_harga'] + $d['tunai'];
  $total_harga += $d['total_harga'];
  $jumlahTerjual += $d['jumlah'];
}

// Tambahkan baris total
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(80, 7, 'Terjual', 1, 0, 'C');
$pdf->Cell(30,7,($jumlahTerjual) . ' Unit',1,1,'C');
$pdf->Cell(80, 7, 'Total', 1, 0, 'C');
$pdf->Cell(30,7,'Rp ' . number_format($total_harga, 2, ',', '.'),1,0,'C');


$pdf->Output();
