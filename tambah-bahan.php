<?php 
	include 'template/header.php';

    if ($level != "inventory") {
        header('location: ../UAS_Digital_Printing/index.php');
        exit;
    }
    
    // Kirim Data ke Functions
    if (isset($_POST['submit'])) {
        if (simpanData('tambah_bahan', $_POST)) {
            echo "<script> alert('Data Bahan Berhasil Disimpan'); window.location = 'data-bahan.php' </script>";
        } else {
            echo "<script> alert('Data Bahan Gagal Disimpan'); window.location = 'data-bahan.php' </script>";
        }
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Tambah Data Bahan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Bahan</li>
          <li class="breadcrumb-item active">Data</li>
          <li class="breadcrumb-item active">Data Tambah Bahan</li>
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
                                    <label for="kode_bahan">Kode Bahan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="kode_bahan" class="form-control" name="kode_bahan" autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="jenis_bahan">Jenis Bahan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="jenis_bahan" class="form-control" name="jenis_bahan" autocomplete="off">
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