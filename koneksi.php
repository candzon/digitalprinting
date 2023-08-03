<?php 
    // Sintaks Koneksi Ke Database
    $koneksi = mysqli_connect("localhost","root","","db_digitalprinting");

    // Fungsi Menampilkan Data Pada 1 Tabel
    function tampilData($file, $data) {
        global $koneksi;

        if ($file == 'data_pelanggan') {
            $query = "SELECT * FROM pelanggan";
        }
        elseif ($file == 'data_print') {
            $query = "SELECT * FROM prints INNER JOIN bahan ON prints.kode_bahan = bahan.kode_bahan";
        }
        elseif ($file == 'data_bahan') {
            $query = "SELECT * FROM bahan";
        }
        elseif ($file == 'detail_pelanggan') {
            $query = "SELECT * FROM pelanggan WHERE kode_pelanggan = '$data'";
        }
        elseif ($file == 'detail_print') {
            $query = "SELECT * FROM prints WHERE kode_print = '$data'";
        }
        elseif ($file == 'detail_bahan') {
            $query = "SELECT * FROM bahan WHERE kode_bahan = '$data'";
        }
        elseif ($file == 'get_bahan') {
            $query = "SELECT * FROM prints WHERE kode_bahan = '$data'";
        }

        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        } 
        return $rows;
    }

// Membuat Function Menyimpan Data Ke Database
    function simpanData($file, $data) {
        global $koneksi;
        // Menyimpan Data ke Tabel Pelanggan
        if ($file == 'tambah_pelanggan') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_pelanggan = $data['kode_pelanggan'];
            $nama_pelanggan = $data['nama_pelanggan'];
            $alamat = $data['alamat'];
            $no_telp = $data['no_telp'];

            // Query Menyimpan Data ke Tabel Anggota
            $query = "INSERT INTO pelanggan VALUES ('$kode_pelanggan','$nama_pelanggan','$alamat','$no_telp')";
        } 
        // Menyimpan Data ke Tabel Print
        elseif ($file == 'tambah_print') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_print = $data['kode_print'];
            $jenis_print = $data['jenis_print'];
            $kode_bahan = $data['kode_bahan'];
            $stok_bahan = $data['stok_bahan'];
            $harga_permeter = $data['harga_permeter'];

            // Query Menyimpan Data ke Tabel Print
            $query = "INSERT INTO prints VALUES ('$kode_print','$jenis_print','$kode_bahan','$stok_bahan','$harga_permeter')";
        }
        // Menyimpan Data ke Tabel Bahan
        elseif ($file == 'tambah_bahan') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_bahan = $data['kode_bahan'];
            $jenis_bahan = $data['jenis_bahan'];

            // Query Menyimpan Data ke Tabel Bahan
            $query = "INSERT INTO bahan VALUES ('$kode_bahan','$jenis_bahan')";
        }
        // Menyimpan Data ke Tabel Peminjaman Header dan Peminjaman Detail
        elseif ($file == 'tambah_pemesanan') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $id_pesan = $data['id_pesan'];
            $kode_pelanggan = $data['kode_pelanggan'];
            $tanggal_pesan = $data['tanggal'];
            $tanggal_selesai = date("Y-m-d", strtotime('+7 days', strtotime($tanggal_pesan)));
            $total_harga = $data['total_harga'];
            $kode_print = $data['kode_print'];
            $harga = $data['harga'];
        
            // Query Menyimpan Data ke Tabel Peminjaman Header
            $query = "INSERT INTO pemesan_header VALUES ('$id_pesan','$kode_pelanggan','$tanggal_pesan', '$tanggal_selesai', '$total_harga')";
        
            $result = mysqli_query($koneksi, $query);
        
            if ($result) {
                $i = 1;
                foreach ($kode_print as $index => $prints) {
                    $jumlah_permeter = $data['jumlah_permeter'];
                    $query2 = "INSERT INTO pemesan_detail VALUES ('$id_pesan', '$prints', '$jumlah_permeter[$index]', '$harga[$index]')";
                    $result2 = mysqli_query($koneksi, $query2);
                    if (!$result2) {
                        return false;
                    }
                    $i++;
                }
                return true;
            } else {
                return false;
            }
        }

        $result = mysqli_query($koneksi, $query);
        return $result;
    }

    // Membuat Kode Otomatis
    function autoNumber($kode) {
        global $koneksi;
         // Kode Pelanggan Otomatis
        if ($kode == 'kode_pelanggan') {
            $query = "SELECT MAX($kode) AS maxKode FROM pelanggan";
            $result = mysqli_fetch_array(mysqli_query($koneksi, $query));
            $kodeOtomatis = $result['maxKode'];
            $noUrut = (int) substr($kodeOtomatis, 2, 4);
            $noUrut++;
            $char = "KP";
            $kodeOtomatis = $char . sprintf("%04s", $noUrut);
        }
        // Kode Peminjaman Otomatis
        elseif ($kode == 'id_pesan') {
            $query = "SELECT MAX($kode) AS maxKode FROM pemesan_header";
            $result = mysqli_fetch_array(mysqli_query($koneksi, $query));
            $kodeOtomatis = $result['maxKode'];
            $noUrut = (int) substr($kodeOtomatis, 4, 4);
            $noUrut++;
            $char = "P";
            $kodeOtomatis = $char . sprintf("%04s", $noUrut);
        }
        
        return $kodeOtomatis;
    }

    // Membuat Function Mengubah Data Ke Database
    function ubahData($file, $data) {
        global $koneksi;
        // Mengubah Data ke Tabel Pelanggan
        if ($file == 'ubah-pelanggan') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_pelanggan = $data['kode_pelanggan'];
            $nama_pelanggan = $data['nama_pelanggan'];
            $alamat = $data['alamat'];
            $no_telp = $data['no_telp'];

            // Query Mengubah Data ke Tabel Pelanggan
            $query = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', no_telp = '$no_telp' WHERE kode_pelanggan = '$kode_pelanggan'";
        }
        // Mengubah Data ke Tabel Print
        elseif ($file == 'ubah-print') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_print = $data['kode_print'];
            $jenis_print = $data['jenis_print'];
            $kode_bahan = $data['kode_bahan'];
            $stok_bahan = $data['stok_bahan'];
            $harga_permeter = $data['harga_permeter'];

            // Query Mengubah Data ke Tabel Print
            $query = "UPDATE prints SET jenis_print = '$jenis_print', kode_bahan = '$kode_bahan', stok_bahan = '$stok_bahan', harga_permeter = '$harga_permeter' WHERE kode_print = '$kode_print'";
        }
        // Mengubah Data ke Tabel Bahan
        elseif ($file == 'ubah-bahan') {
            // Kiri sesuai dengan Tabel dan Kanan sesuai dengan Name Form
            $kode_bahan = $data['kode_bahan'];
            $jenis_bahan = $data['jenis_bahan'];

            // Query Mengubah Data ke Tabel Bahan
            $query = "UPDATE bahan SET jenis_bahan = '$jenis_bahan' WHERE kode_bahan = '$kode_bahan'";
        }

        $result = mysqli_query($koneksi, $query);
        return $result;
    }

    // Function Laporan Peminjaman
    function laporanPemesanan($awal, $akhir) {
        global $koneksi;
        if ($awal == TRUE && $akhir == TRUE) {
            $query = "SELECT * FROM pemesan_header ph 
                        INNER JOIN pelanggan pe ON ph.kode_pelanggan = pe.kode_pelanggan
                        INNER JOIN pemesan_detail pd ON ph.id_pesan = pd.id_pesan
                        INNER JOIN prints pr ON pd.kode_print = pr.kode_print
                        WHERE tanggal_pesan BETWEEN '$awal' AND '$akhir'";
        }

        elseif ($awal == TRUE) {
            $query = "SELECT * FROM pemesan_header ph 
                        INNER JOIN pelanggan pe ON ph.kode_pelanggan = pe.kode_pelanggan
                        INNER JOIN pemesan_detail pd ON ph.id_pesan = pd.id_pesan
                        INNER JOIN prints pr ON pd.kode_print = pr.kode_print
                        WHERE tanggal_pesan >= '$awal'";
        }

        elseif ($akhir == TRUE) {
            $query = "SELECT * FROM pemesan_header ph 
                        INNER JOIN pelanggan pe ON ph.kode_pelanggan = pe.kode_pelanggan
                        INNER JOIN pemesan_detail pd ON ph.id_pesan = pd.id_pesan
                        INNER JOIN prints pr ON pd.kode_print = pr.kode_print
                        WHERE tanggal_pesan <= '$akhir'";
        }

        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        } 
        return $rows;
    }

    // Membuat Function Menghapus Data Ke Database
    function hapusData($file, $primary, $data) {
        global $koneksi;
        if ($file == 'hapus_pelanggan') {
            $query = "DELETE FROM pelanggan WHERE $primary = '$data'";
        }
        elseif ($file == 'hapus_print') {
            $query = "DELETE FROM prints WHERE $primary = '$data'";
        }
        elseif ($file == 'hapus_bahan') {
            $query = "DELETE FROM bahan WHERE $primary = '$data'";
        }

        $result = mysqli_query($koneksi, $query);
        return $result;
    }
?>