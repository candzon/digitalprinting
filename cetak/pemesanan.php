<?php 
    require '../pdf/fpdf.php';
    include '../koneksi.php';

    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    if ($awal == TRUE && $akhir == TRUE) {
        $pemesanan = laporanPemesanan($awal, $akhir);
    }
    elseif ($awal == TRUE) {
        $pemesanan = laporanPemesanan($awal, '');
    } elseif ($akhir == TRUE) {
        $pemesanan = laporanPemesanan('', $akhir);
    }

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf -> AddPage();

    $pdf -> SetFont('Arial', 'B', 20);
    $pdf -> Cell(280, 10, 'LAPORAN DATA PEMESANAN', 0, 0, 'C');

    $pdf -> Cell(10, 15, '', 0, 1);
    $pdf -> SetFont('Arial', 'B', 9);
    $pdf -> Cell(10, 6, 'No.', 1, 0, 'C');
    $pdf -> Cell(20, 6, 'Kode', 1, 0, 'C');
    $pdf -> Cell(30, 6, 'Tanggal', 1, 0, 'C');
    $pdf -> Cell(40, 6, 'Kode Pelanggan', 1, 0, 'C');
    $pdf -> Cell(68, 6, 'Nama Pelanggan', 1, 0, 'C');
    $pdf -> Cell(40, 6, 'Jenis Print', 1, 0, 'C');
    $pdf -> Cell(40, 6, 'Jenis Bahan', 1, 0, 'C');
    $pdf -> Cell(30, 6, 'Jumlah', 1, 1, 'C');

    $pdf -> SetFont('Arial', '', 10);
        
    $no = 1;
    foreach($pemesanan as $rows) : 
        $pdf -> Cell(10, 6, $no++, 1, 0, 'C');
        $pdf -> Cell(20, 6, $rows['id_pesan'], 1, 0);
        $pdf -> Cell(30, 6, $rows['tanggal_pesan'], 1, 0);
        $pdf -> Cell(40, 6, $rows['kode_pelanggan'], 1, 0);
        $pdf -> Cell(68, 6, $rows['nama_pelanggan'], 1, 0);
        $pdf -> Cell(40, 6, $rows['kode_print'], 1, 0);
        $pdf -> Cell(40, 6, $rows['kode_bahan'], 1, 0);
        $pdf -> Cell(30, 6, $rows['jumlah_permeter'], 1, 1);
    endforeach;

    $pdf -> Output();
?>