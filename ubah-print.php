<?php 
	include 'template/header.php';
    $data = tampilData('detail_print', $_GET['kode_print'])[0];

    if ($level != "inventory") {
        header('location: ../UAS_Digital_Printing/index.php');
        exit;
    }
    
    // Kirim Data ke Functions
    if (isset($_POST['submit'])) {
        if (ubahData('ubah-print', $_POST)) {
            echo "<script> alert('Data Print Berhasil Diubah'); window.location = 'data-print.php' </script>";
        } else {
            echo "<script> alert('Data Print Gagal Diubah'); window.location = 'data-print.php' </script>";
        }
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Ubah Data Print</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Print</li>
            <li class="breadcrumb-item active">Data</li>
            <li class="breadcrumb-item active">Data Ubah Print</li>
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
                                    <label for="kode_print">Kode Print</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="kode_print" class="form-control" name="kode_print" value="<?= $data['kode_print']; ?>" readonly autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="jenis_print">Jenis Print</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="jenis_print" class="form-control" name="jenis_print" value="<?= $data['jenis_print']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="kode_bahan">Kode Bahan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="kode_bahan" class="form-control" name="kode_bahan" value="<?= $data['kode_bahan']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="stok_bahan">Stok Bahan</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="stok_bahan" class="form-control" name="stok_bahan" value="<?= $data['stok_bahan']; ?>" autocomplete="off">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="harga_permeter">Harga Permeter</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <input type="text" id="harga_permeter" class="form-control" name="harga_permeter" value="<?= $data['harga_permeter']; ?>" autocomplete="off">
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