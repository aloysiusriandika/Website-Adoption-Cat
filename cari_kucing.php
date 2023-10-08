<?php include 'layout/header.php'; ?>
<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
        Daftar Kucing
      </h2>
      <div class="page-pretitle">
        Temukan kucing yang ingin anda adopsi disini
      </div>

    </div>
  </div>
</div>

<form method="GET">
  <div class="row">
    <div class="col-md-12">
      <input type="text" class="form-control input-lg" placeholder="Cari Kucing Disini..." autocomplete="off" name="keyword">
    </div>
  </div>
</form>

<?php

if (isset($_GET['keyword'])) {
  $query = mysqli_query($koneksi, "SELECT kucing.*, user.nama, user.email FROM kucing JOIN user ON user.id = kucing.user_id WHERE is_adopted = '0' AND status = 'acc' AND judul_iklan LIKE '%" . $_GET['keyword'] . "%'");
} else {
  $query = mysqli_query($koneksi, "SELECT kucing.*, user.nama, user.email FROM kucing JOIN user ON user.id = kucing.user_id WHERE is_adopted = '0' AND status = 'acc'");
}

?>

<div class="row mt-3">
  <?php while ($kucing = mysqli_fetch_array($query)) { ?>
    <div class="col-md-4">
      <a href="detail_kucing.php?id=<?= $kucing['id'] ?>" style="text-decoration: none">
        <div class="card">
          <div class="card-body">
            <div class="card-img-top img-responsive img-responsive-16by9" style="background-image: url(adopt_img/<?= $kucing['foto'] ?>)"></div>
            <h3 class="card-title mt-3" style="color: #232e3c"><?= $kucing['judul_iklan'] ?></h3>
            <p>Post : <?= date('d-m-Y H:i', strtotime($kucing['tanggal_konfirmasi'])) ?></p>
          </div>

          <div class="card-footer">
            <div class="row align-items-center">
              <div class="ms-auto">
                <div class="avatar-list avatar-list-stacked">
                  <span class="avatar avatar-sm avatar-rounded" style="background-image: url(assets/img/paw.jpg)"></span> <span class="mt-1">&emsp; <?= $kucing['nama'] ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  <?php } ?>

</div>

<?php include 'layout/footer.php'; ?>