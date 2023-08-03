<?php
    include 'koneksi.php';

    $kode_bahan = $_GET['kode_bahan'];

    $query_bahan = mysqli_query($koneksi, "SELECT * FROM prints WHERE kode_bahan = '$kode_bahan'");
    $prints = mysqli_fetch_array($query_bahan);

    $data = array(
    'stok_bahan' => @$prints['stok_bahan'],
    'harga_permeter' => @$prints['harga_permeter']
    );

    echo json_encode($data);
?>