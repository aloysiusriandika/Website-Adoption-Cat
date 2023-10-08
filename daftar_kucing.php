<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
        Daftar Kucing
      </h2>
      <div class="page-pretitle">
        Tambahkan kucing untuk iklan adopsi
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <?php
        if (isset($_SESSION['alert'])) {
          echo $_SESSION['alert'];
          unset($_SESSION['alert']);
        }
        ?>

        <?php if ($_SESSION['login_data']['akses'] != 'admin') { ?>
          <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-simple">Tambah Data</a>
        <?php } ?>


        <table class="table mt-3">
          <thead>
            <tr>
              <th style="width: 5%">No</th>
              <th style="width: 13%">Foto</th>
              <th>Nama</th>
              <th>Jenis</th>
              <th>Umur</th>
              <th>Jenis Kelamin</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            if ($_SESSION['login_data']['akses'] == 'admin') {
              $query = mysqli_query($koneksi, "SELECT * FROM kucing") or die(mysqli_error($koneksi));
            } else {
              $query = mysqli_query($koneksi, "SELECT * FROM kucing WHERE user_id='" . $_SESSION['login_data']['id'] . "'") or die(mysqli_error($koneksi));
            }


            $i = 1;
            while ($kucing = mysqli_fetch_array($query)) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><img src="adopt_img/<?= $kucing['foto'] ?>" style="width: 100px; height: 100px"></td>
                <td><?= $kucing['nama_kucing'] ?></td>
                <td><?= $kucing['jenis'] ?></td>
                <td><?= $kucing['umur'] ?></td>
                <td><?= $kucing['jenis_kelamin'] ?></td>
                <td><?php
                    if ($kucing['status'] == 'pending') {
                      echo "<span class='badge badge-info'>Menunggu konfirmasi admin</span>";
                    } else if ($kucing['status'] == 'acc') {
                      echo "<span class='badge badge-success'>Disetujui</span>";
                    } else {
                      echo "<span class='badge badge-danger'>Ditolak</span>";
                    }
                    ?></td>
                <td>

                  <a class="btn btn-primary" href="daftar_kucing_detail.php?id=<?= $kucing['id'] ?>">Lihat Detail</a>

                  <?php  ?>
                  <a href="daftar_kucing_ubah.php?id=<?= $kucing['id'] ?>" class="btn btn-warning">Ubah</a>
                  <a href="proses/kucing_hapus.php?id=<?= $kucing['id'] ?>" onclick="return confirm('Hapus data ?')" class="btn btn-danger">Hapus</a>
                  <?php ?>

                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<form method="POST" action="proses/kucing_tambah.php" enctype="multipart/form-data">
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Kucing</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Judul Iklan</label>
            <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan judul iklan" name="judul_iklan" required="">
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Kucing</label>
            <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama kucing" name="nama_kucing" required="">
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Kucing</label>
            <input type="text" class="form-control" autocomplete="off" placeholder="Ex : Persia, Anggota, dll." name="jenis" required="">
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-control" required="" name="jenis_kelamin">
              <option value="">Pilih</option>
              <option value="Jantan">Jantan</option>
              <option value="Betina">Betina</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Umur</label>
            <select class="form-control" required="" name="umur">
              <option value="">Pilih</option>
              <option value="Kitten">Kitten</option>
              <option value="Young">Young</option>
              <option value="Adult">Adult</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" required="" name="deskripsi" placeholder="Ketikkan deskripsi kucing yang akan diadopsi"></textarea>
          </div>

          <div class="mb-2">
            <label class="form-label">Foto</label>
            <input type="file" required="" name="img" class="btn btn-light">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php include 'layout/footer.php'; ?>