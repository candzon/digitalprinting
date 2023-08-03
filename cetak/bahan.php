<?php 
    require '../pdf/fpdf.php';
    include '../koneksi.php';

    if ($_POST['kode_bahan']) {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf -> AddPage();

        $pdf -> SetFont('Arial', 'B', 13);
        $pdf -> Cell(200, 10, 'LAPORAN DATA BAHAN DIGITAL PRINTING', 0, 0, 'C');

        $pdf -> Cell(10, 15, '', 0, 1);
        $pdf -> SetFont('Arial', 'B', 9);
        $pdf -> Cell(10, 6, 'No.', 1, 0, 'C');
        $pdf -> Cell(60, 6, 'Kode Bahan', 1, 0, 'C');
        $pdf -> Cell(60, 6, 'Stok Bahan', 1, 0, 'C');
        $pdf -> Cell(60, 6, 'Harga Permeter', 1, 1, 'C');

        $pdf -> SetFont('Arial', '', 10);

        $prints = tampilData('data_print', '');

        if ($_POST['kode_bahan'] == 1) {
            $prints = tampilData('data_print', '');
        } else {
            $prints = tampilData('get_bahan',  $_POST['kode_bahan']);
        };
        
        $no = 1;
        foreach($prints as $rows) :

            $pdf -> Cell(10, 6, $no++, 1, 0, 'C');
            $pdf -> Cell(60, 6, $rows['kode_bahan'], 1, 0);
            $pdf -> Cell(60, 6, $rows['stok_bahan'], 1, 0);
            $pdf -> Cell(60, 6, $rows['harga_permeter'], 1, 1);
        endforeach;

        $pdf -> Output();
    }
?>