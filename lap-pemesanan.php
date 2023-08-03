<?php 
	include 'template/header.php';

    if ($level != "sales" AND $level != "finance") {
        header('location: ../UAS_Digital_Printing/index.php');
        exit;
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Laporan Pemesanan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pemesanan</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title mb-0"></div>
                    <form action="cetak/pemesanan.php" method="POST">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label>Tanggal Awal</label>
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <input type="date" name="awal" class="form-control">
                            </div>
                            
                            <div class="col-md-2 mb-3">
                                <label>Tanggal Akhir</label>
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <input type="date" name="akhir" class="form-control">
                            </div>
                            
                            <div class="col-sm-12 d-flex justify-content-start">
                                <input type="submit" class="btn btn-primary me-1 mb-1" name="submit" value="Cetak Data">
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