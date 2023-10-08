<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
      Dashboard
      </h2>
      <div class="page-pretitle">
        Panel dashboard admin
      </div>
      
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header"><b>Jumlah Iklan Adopsi</b></div>
      <div class="card-body text-center">
        <?php $query = mysqli_query($koneksi, "SELECT * FROM kucing WHERE status = 'acc'"); ?>
        <h1><?= mysqli_num_rows($query); ?></h1>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header"><b>Jumlah Berhasil Adopsi</b></div>
      <div class="card-body text-center">
        <?php $query = mysqli_query($koneksi, "SELECT * FROM adopsi WHERE is_adoption = '1'"); ?>
        <h1><?= mysqli_num_rows($query); ?></h1>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header"><b>Jumlah User</b></div>
      <div class="card-body text-center">
        <?php $query = mysqli_query($koneksi, "SELECT * FROM user WHERE akses = 'user'"); ?>
        <h1><?= mysqli_num_rows($query); ?></h1>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>