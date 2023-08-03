<?php 
    require '../pdf/fpdf.php';
    include '../koneksi.php';

    if ($_POST['kode_pelanggan']) {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf -> AddPage();

        $pdf -> SetFont('Arial', 'B', 13);
        $pdf -> Cell(200, 10, 'LAPORAN DATA PELANGGAN DIGITAL PRINTING', 0, 0, 'C');

        $pdf -> Cell(10, 15, '', 0, 1);
        $pdf -> SetFont('Arial', 'B', 9);
        $pdf -> Cell(10, 6, 'No.', 1, 0, 'C');
        $pdf -> Cell(30, 6, 'Kode Pelanggan', 1, 0, 'C');
        $pdf -> Cell(50, 6, 'Nama Pelanggan', 1, 0, 'C');
        $pdf -> Cell(50, 6, 'Alamat', 1, 0, 'C');
        $pdf -> Cell(50, 6, 'No Telp', 1, 1, 'C');

        $pdf -> SetFont('Arial', '', 10);

        $pelanggan = tampilData('data_pelanggan', '');

        if ($_POST['kode_pelanggan'] == 1) {
            $pelanggan = tampilData('data_pelanggan', '');
        } else {
            $pelanggan = tampilData('detail_pelanggan',  $_POST['kode_pelanggan']);
        };
        
        $no = 1;
        foreach($pelanggan as $rows) : 
            $pdf -> Cell(10, 6, $no++, 1, 0, 'C');
            $pdf -> Cell(30, 6, $rows['kode_pelanggan'], 1, 0);
            $pdf -> Cell(50, 6, $rows['nama_pelanggan'], 1, 0);
            $pdf -> Cell(50, 6, $rows['alamat'], 1, 0);
            $pdf -> Cell(50, 6, $rows['no_telp'], 1, 1);
        endforeach;

        $pdf -> Output();
    }
?>