<?php 
	include 'template/header.php';

    if ($level != "inventory") {
        header('location: ../UAS_Digital_Printing/index.php');
        exit;
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Laporan Print</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Print</li>
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
                        <form action="cetak/print.php" method="POST">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="prints">Cetak Jenis Print</label>
                                </div>
                                <div class="col-md-10 mb-3 form-group">
                                    <select name="kode_print" id="prints" class="form-select">
                                        <option value="1" selected>Semua Jenis Print</option>
                                        <?php 
                                            $cariData = tampilData('data_print', '');
                                            foreach ($cariData as $row) : 
                                        ?>
                                        <option value="<?= $row['kode_print']; ?>"> <?= $row['jenis_print']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
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