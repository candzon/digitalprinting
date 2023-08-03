<?php 
    error_reporting(0);

    include 'koneksi.php';

    if ($_GET['kode_pelanggan']){
        if (hapusData('hapus_pelanggan', 'kode_pelanggan', $_GET['kode_pelanggan'])) {
            echo "<script> alert('Data Pelanggan Berhasil Dihapus'); window.location = 'data-pelanggan.php' </script>";
        } else {
            echo "<script> alert('Data Pelanggan Gagal Dihapus'); window.location = 'data-pelanggan.php' </script>";
        }
    }

    elseif ($_GET['kode_print']){
        if (hapusData('hapus_print', 'kode_print', $_GET['kode_print'])) {
            echo "<script> alert('Data Print Berhasil Dihapus'); window.location = 'data-print.php' </script>";
        } else {
            echo "<script> alert('Data Print Gagal Dihapus'); window.location = 'data-print.php' </script>";
        }
    }

    elseif ($_GET['kode_bahan']){
        if (hapusData('hapus_bahan', 'kode_bahan', $_GET['kode_bahan'])) {
            echo "<script> alert('Data Bahan Berhasil Dihapus'); window.location = 'data-bahan.php' </script>";
        } else {
            echo "<script> alert('Data Bahan Gagal Dihapus'); window.location = 'data-bahan.php' </script>";
        }
    }
?>