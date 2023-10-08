<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
        Ubah Kucing
      </h2>
      <div class="page-pretitle">
        Ubah detail kucing yang akan diadopsi
      </div>

    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
      <div class="btn-list">
        <span class="d-none d-sm-inline">
          <a href="daftar_kucing.php" class="btn btn-white">
            Kembali
          </a>
        </span>
      </div>
    </div>
  </div>
</div>

<?php

$query    = mysqli_query($koneksi, 'SELECT * FROM kucing WHERE id="' . $_GET['id'] . '"');
$kucing   = mysqli_fetch_assoc($query);

?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <?php
            if (isset($_SESSION['alert'])) {
              echo $_SESSION['alert'];
              unset($_SESSION['alert']);
            }
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <h4>Informasi Kucing</h4>
            <form method="POST" action="proses/kucing_ubah_info.php?id=<?= $kucing['id'] ?>">
              <div class="mb-3">
                <label class="form-label">Judul Iklan</label>
                <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan judul iklan" name="judul_iklan" required="" value="<?= $kucing['judul_iklan'] ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Nama Kucing</label>
                <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama kucing" name="nama_kucing" required="" value="<?= $kucing['nama_kucing'] ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Jenis Kucing</label>
                <input type="text" class="form-control" autocomplete="off" placeholder="Ex : Persia, Anggota, dll." name="jenis" required="" value="<?= $kucing['jenis'] ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" required="" name="jenis_kelamin">
                  <option value="">Pilih</option>
                  <option value="Jantan" <?= $kucing['jenis_kelamin'] == 'Jantan' ? 'selected="selected"' : '' ?>>Jantan</option>
                  <option value="Betina" <?= $kucing['jenis_kelamin'] == 'Betina' ? 'selected="selected"' : '' ?>>Betina</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Umur</label>
                <select class="form-control" required="" name="umur">
                  <option value="">Pilih</option>
                  <option <?= $kucing['umur'] == 'Kitten' ? 'selected="selected"' : '' ?> value="Kitten">Kitten</option>
                  <option <?= $kucing['umur'] == 'Young' ? 'selected="selected"' : '' ?> value="Young">Young</option>
                  <option <?= $kucing['umur'] == 'Adult' ? 'selected="selected"' : '' ?> value="Adult">Adult</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" required="" name="deskripsi" placeholder="Ketikkan deskripsi kucing yang akan diadopsi"><?= $kucing['deskripsi'] ?></textarea>
              </div>

              <button class="btn btn-warning mt-3">Ubah Data</button>

            </form>
          </div>

          <div class="col-md-4">
            <h4>Foto</h4>
            <form method="POST" action="proses/kucing_ubah_foto.php?id=<?= $kucing['id'] ?>" enctype="multipart/form-data">
              <img src="adopt_img/<?= $kucing['foto'] ?>" style="width: 100px; height: 100px">
              <div class="mt-2">
                <input type="file" required="" name="img" class="btn btn-light" required="">
              </div>

              <button class="btn btn-warning mt-3">Ganti Foto</button>
            </form>
          </div>


        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>