<?php 
    require '../pdf/fpdf.php';
    include '../koneksi.php';

    if ($_POST['kode_print']) {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf -> AddPage();

        $pdf -> SetFont('Arial', 'B', 13);
        $pdf -> Cell(200, 10, 'LAPORAN DATA PRINT DIGITAL PRINTING', 0, 0, 'C');

        $pdf -> Cell(10, 15, '', 0, 1);
        $pdf -> SetFont('Arial', 'B', 9);
        $pdf -> Cell(10, 6, 'No.', 1, 0, 'C');
        $pdf -> Cell(90, 6, 'Kode Print', 1, 0, 'C');
        $pdf -> Cell(90, 6, 'Jenis Print', 1, 1, 'C');

        $pdf -> SetFont('Arial', '', 10);

        $prints = tampilData('data_print', '');

        if ($_POST['kode_print'] == 1) {
            $prints = tampilData('data_print', '');
        } else {
            $prints = tampilData('detail_print',  $_POST['kode_print']);
        };
        
        $no = 1;
        foreach($prints as $rows) : 
            $pdf -> Cell(10, 6, $no++, 1, 0, 'C');
            $pdf -> Cell(90, 6, $rows['kode_print'], 1, 0);
            $pdf -> Cell(90, 6, $rows['jenis_print'], 1, 1);
        endforeach;

        $pdf -> Output();
    }
?>