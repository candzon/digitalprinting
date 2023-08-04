<?php
include 'template/header.php';

if ($level != "pelanggan") {
    header('location: ../UAS_Digital_Printing/index.php');
    exit;
}

$tanggal = date("Y-m-d");

// Kirim Data ke Functions
if (isset($_POST['submit'])) {
    if (simpanData('tambah_pemesanan', $_POST)) {
        echo "<script> alert('Data Pemesanan Berhasil Disimpan'); window.location = 'index.php' </script>";
    } else {
        echo "<script> alert('Data Pemesanan Gagal Disimpan'); window.location = 'index.php' </script>";
    }
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1><strong>Menu </strong>Transksi Pemesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pemesanan</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="card-title mb-0"></div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div id="keranjang">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="id_pesan">Kode Pemesanan</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="id_pesan" class="form-control" name="id_pesan" value="<?php echo autoNumber('id_pesan') ?>" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="tanggal">Tanggal</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="tanggal" class="form-control" name="tanggal" value="<?= $tanggal; ?>" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="kode_pelanggan">Kode Pelanggan</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="kode_pelanggan" class="form-control" name="kode_pelanggan" onkeyup="isi_otomatis()" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="nama_pelanggan" class="form-control" name="nama_pelanggan" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Jenis Print</th>
                                    <th>Jenis Bahan</th>
                                    <th>Jumlah Permeter</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td style="width: 300px;">
                                        <select class="form-select" name="kode_print[]" id="kode_print">
                                            <option value="" hidden>Pilih Jenis Print</option>
                                            <?php
                                            $result = tampilData("data_print", '');
                                            foreach ($result as $row) :
                                            ?>
                                                <option value="<?= $row["kode_print"]; ?>"> <?= $row["jenis_print"]; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td style="width: 300px;">
                                        <select class="form-select" name="kode_bahan[]" id="kode_bahan" onchange="isi_otomatis2(this)" required>
                                            <option value="" hidden>Pilih Jenis Bahan</option>
                                            <?php
                                            $result = tampilData("data_bahan", '');
                                            foreach ($result as $row) :
                                            ?>
                                                <option value="<?= $row["kode_bahan"]; ?>" data-stok="<?= $row["stok_bahan"]; ?>" data-harga="<?= $row["harga_permeter"]; ?>"> <?= $row["jenis_bahan"]; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td style="width: 160px;">
                                        <input type="number" class="form-control" id="jumlah_permeter" name="jumlah_permeter[]" required>
                                    </td>

                                    <td style="width: 150px;">
                                        <input type="number" class="form-control stok_bahan" id="stok_bahan" name="stok_bahan[]" readonly>
                                    </td>

                                    <td style="width: 200px;">
                                        <input type="number" class="form-control harga_permeter" id="harga_permeter" name="harga[]" readonly>
                                    </td>

                                    <td>
                                        <button class="btn btn-success add_item_btn" style="width: 100px;">Tambah</button>
                                    </td>

                            <tbody id="show_item"></tbody>

                            <tbody>
                                <tr>
                                    <td style="width: 300px;"></td>
                                    <td style="width: 300px;"></td>
                                    <td style="width: 160px;"></td>

                                    <td style="width: 150px;">
                                        <label for="total_harga"><strong>Total Harga</strong></label>
                                    </td>
                                    <td style="width: auto; white-space: nowrap;">
                                        <input type="number" class="form-control total_harga" id="total_harga" name="total_harga" style="width: 100%;" readonly>
                                    </td>
                                </tr>
                            </tbody>

                            </tr>
                            </tbody>

                        </table>

                    </div>
                    <div class="row">
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>


<script type="text/javascript">
    function isi_otomatis() {
        var kode_pelanggan = $("#kode_pelanggan").val();
        $.ajax({
            url: 'ajax.php',
            data: "kode_pelanggan=" + kode_pelanggan,
        }).success(function(data) {
            var json = data,
                obj = JSON.parse(json);
            $('#nama_pelanggan').val(obj.nama_pelanggan);
        });
    }

    function isi_otomatis2(element) {
        var kode_bahan = $(element).val();
        var row_item = $(element).closest('tr');
        $.ajax({
            url: 'ajax2.php',
            data: {
                kode_bahan: kode_bahan
            },
            dataType: 'json',
        }).done(function(data) {
            $(row_item).find('.stok_bahan').val(data.stok_bahan);
            $(row_item).find('.harga_permeter').val(data.harga_permeter);
        }).fail(function() {
            alert('Gagal memuat data obat.');
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(
                `<tr>

                    <td style="width: 300px;">
                        <select class="form-select" name="kode_print[]" id="kode_print">
                            <option value="" hidden>Pilih Jenis Print</option>
                                <?php
                                $result = tampilData("data_print", '');
                                foreach ($result as $row) :
                                ?>
                                <option value="<?= $row["kode_print"]; ?>"> <?= $row["jenis_print"]; ?> </option>
                                <?php endforeach; ?>
                                </select>
                    </td>
                    
                    <td style="width: 300px;">
                        <select class="form-select" name="kode_bahan[]" id="kode_bahan" onchange="isi_otomatis2(this)" required>
                            <option value="" hidden>Pilih Jenis Bahan</option>
                                <?php
                                $result = tampilData("data_bahan", '');
                                foreach ($result as $row) :
                                ?>
                                <option value="<?= $row["kode_bahan"]; ?>" data-stok="<?= $row["stok_bahan"]; ?>" data-harga="<?= $row["harga_permeter"]; ?>"> <?= $row["jenis_bahan"]; ?> </option>
                                <?php endforeach; ?>
                                </select>
                    </td>

                    <td style="width: 160px;">
                        <input type="number" class="form-control" id="jumlah_permeter" name="jumlah_permeter[]">
                    </td>

                    <td style="width: 150px;">
                        <input type="number" class="form-control stok_bahan" id="stok_bahan" name="stok_bahan[]" readonly>
                    </td>

                    <td style="width: 200px;">
                        <input type="number" class="form-control harga_permeter" id="harga_permeter" name="harga[]" readonly>
                    </td>

                    <td>
                        <button class="btn btn-danger remove_item_btn" style="width: 100px;">Hapus</button>
                    </td>
                </tr>`
            );
        });
        $(document).on('click', '.remove_item_btn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        function calculateTotal() {
            var hargaSatuanInputs = $(".harga_permeter");
            var jumlahInputs = $("input[name='jumlah_permeter[]']");

            var totalharga = 0;

            // Menghitung total harga
            for (var i = 0; i < hargaSatuanInputs.length; i++) {
                var hargaSatuan = $(hargaSatuanInputs[i]).val();
                var jumlah = $(jumlahInputs[i]).val();
                var subtotal = hargaSatuan * jumlah;

                totalharga += subtotal;
            }

            // Menampilkan total bayar pada input dengan id "total_harga"
            $("#total_harga").val(totalharga);
        }

        // Panggil fungsi untuk pertama kali saat halaman dimuat
        calculateTotal();

        // Gunakan event input pada input fields yang terlibat
        $(".harga_permeter, input[name='jumlah_permeter[]']").on("input", function() {
            calculateTotal();
        });
    });
</script>

<?php
include 'template/footer.php';
?>