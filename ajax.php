<?php
    include 'koneksi.php';

    $kode_pelanggan = $_GET['kode_pelanggan'];

    $query_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kode_pelanggan = '$kode_pelanggan'");
    $pelanggan = mysqli_fetch_array($query_pelanggan);

    $data = array(
    'nama_pelanggan' => @$pelanggan['nama_pelanggan']
    );

    echo json_encode($data);
?>