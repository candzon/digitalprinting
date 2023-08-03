<?php 
	include 'template/header.php';
    $data = tampilData('data_pelanggan', '');

    if ($level != "analyst") {
      header('location: ../UAS_Digital_Printing/index.php');
      exit;
    }
?>

<main id="main" class="main">

    <div class="pagetitle"><h1><strong>Menu </strong>Data Pelanggan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Pelanggan</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <h5 class="card-title mb-0"><a href="tambah-pelanggan.php" class="btn btn-primary">Tambah Data Pelanggan</a></h5>
              
            <table class="table ">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
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
                      <td><?= $rows['kode_pelanggan']; ?></td>
                      <td><?= $rows['nama_pelanggan']; ?></td>
                      <td><?= $rows['alamat']; ?></td>
                      <td><?= $rows['no_telp']; ?></td>
                      <td>
                        <a href="ubah-pelanggan.php?kode_pelanggan=<?= $rows['kode_pelanggan']; ?>" class="btn btn-primary">Ubah</a>
                        <a href="hapus-data.php?kode_pelanggan=<?= $rows['kode_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
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

