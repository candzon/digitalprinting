<?php 
	include 'template/header.php';
    $data = tampilData('data_print', '');

    if ($level != "inventory" AND $level != "pelanggan") {
      header('location: ../UAS_Digital_Printing/index.php');
      exit;
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Data Print</h1>
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
            <h5 class="card-title mb-0"><a href="tambah-print.php" class="btn btn-primary">Tambah Data Print</a></h5>
              
            <table class="table ">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Jenis Print</th>
                    <th>Harga Permeter</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                                  <?php 
                                    $i = 1;
                                    foreach ($data as $rows) :
                                  ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $rows['jenis_print']; ?></td>
                                    <td><?= $rows['harga_permeter']; ?></td>
                                    <td>
                                        <a href="ubah-print.php?kode_print=<?= $rows['kode_print']; ?>" class="btn btn-primary">Ubah</a>
                                        <a href="hapus-data.php?kode_print=<?= $rows['kode_print']; ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php 
	include 'template/footer.php';
?>

