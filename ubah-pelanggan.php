<?php 
	include 'template/header.php';
    $data = tampilData('detail_pelanggan', $_GET['kode_pelanggan'])[0];

    if ($level != "analyst") {
        header('location: ../UAS_Digital_Printing/index.php');
        exit;
    }
    
    // Kirim Data ke Functions
    if (isset($_POST['submit'])) {
        if (ubahData('ubah-pelanggan', $_POST)) {
            echo "<script> alert('Data Pelanggan Berhasil Diubah'); window.location = 'data-pelanggan.php' </script>";
        } else {
            echo "<script> alert('Data Pelanggan Gagal Diubah'); window.location = 'data-pelanggan.php' </script>";
        }
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Ubah Data Pelanggan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Pelanggan</li>
          <li class="breadcrumb-item active">Data</li>
          <li class="breadcrumb-item active">Data Ubah Pelanggan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-0"></div>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="kode_pelanggan">Kode Pelanggan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="kode_pelanggan" class="form-control" name="kode_pelanggan" value="<?= $data['kode_pelanggan']; ?>" readonly autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="nama_pelanggan" class="form-control" name="nama_pelanggan" value="<?= $data['nama_pelanggan']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control"><?= $data['alamat']; ?></textarea>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="no_telp">Nomor Telepon</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="no_telp" class="form-control" name="no_telp" value="<?= $data['no_telp']; ?>" autocomplete="off">
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
	include 'template/footer.php';
?>