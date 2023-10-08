<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
        Detail Kucing
      </h2>
      <div class="page-pretitle">
        Ketahui detail kucing yang akan diadopsi
      </div>
      
    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
      <div class="btn-list">
        <span class="d-none d-sm-inline">
          <a href="cari_kucing.php" class="btn btn-white">
            Kembali
          </a>
        </span>
      </div>
    </div>
  </div>
</div>

<?php 
  
  $query = mysqli_query($koneksi, "SELECT kucing.*, user.nama, user.email FROM kucing JOIN user ON user.id = kucing.user_id WHERE is_adopted = '0' AND status = 'acc' AND kucing.id='".$_GET['id']."'") or die(mysqli_error($koneksi));
  $kucing = mysqli_fetch_assoc($query);

  if(isset($_SESSION['login'])){
    $query  = mysqli_query($koneksi, "SELECT * FROM adopsi WHERE kucing_id='".$_GET['id']."' AND user_id='".$_SESSION['login_data']['id']."'");
    $adopsi = mysqli_fetch_assoc($query);
  }
  
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <?php 
              if(isset($_SESSION['alert'])){
                 echo $_SESSION['alert'];
                 unset($_SESSION['alert']);
              }
           ?>

        <center>
          <img src="adopt_img/<?= $kucing['foto'] ?>" class="img-fluid" style="width: 50%">
        </center>

        <div class="card-footer mt-3 mb-4">
          <div class="row">
            <div class="col-md-8">
              <span style="font-size:18px"><b><?= $kucing['judul_iklan'] ?></b></span>
            </div>
            <div class="col-md-4">
              <div class="avatar-list avatar-list-stacked" style="float: right">
                <span class="avatar avatar-sm avatar-rounded" style="background-image: url(assets/img/paw.jpg)"></span> <span class="mt-1">&emsp; <?= $kucing['nama'] ?></span>
              </div>
            </div>
          </div>
          
        </div>

        <div class="row">
          <div class="col-md-4">
            <h3>Informasi</h3>
            <table class="table">
              <tr>
                <td>Nama</td>
                <th class="text-right"><?= $kucing['nama_kucing'] ?></th>
              </tr>

              <tr>
                <td>Jenis</td>
                <th class="text-right"><?= $kucing['jenis'] ?></th>
              </tr>

              <tr>
                <td>Umur</td>
                <th class="text-right"><?= $kucing['umur'] ?></th>
              </tr>

              <tr>
                <td>Jenis Kelamin</td>
                <th class="text-right"><?= $kucing['jenis_kelamin'] ?></th>
              </tr>

              <tr class="bg-light">
                <th colspan="2" class="text-center">
                  <?php if(isset($_SESSION['login'])){ ?>

                    <?php if(!empty($adopsi)){ ?>
                      <h4 class="text-danger">Anda sudah melakukan request adopsi</h4>
                    
                    <?php }else{ ?>
                     <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-simple">ADOPSI SEKARANG</a>
                    <?php } ?>

                  <?php }else{ ?>
                    <h4 class="text-danger">Silahkan Login untuk melakukan adopsi</h4>
                  <?php } ?>
                  
                  
                </th>
              </tr>
            </table>
          </div>

          <div class="col-md-8">
            <h3>Keterangan</h3>
            <p><?= $kucing['deskripsi'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>


<form method="POST" action="proses/kucing_request_adopsi.php?id=<?= $kucing['id'] ?>" enctype="multipart/form-data">
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Request Adopsi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="mb-3">
             <label class="form-label">Alasan Adopsi</label>
             <textarea class="form-control" required="" name="alasan_adopsi" placeholder="Ketikkan alasan pengadopsian kucing ini"></textarea>
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