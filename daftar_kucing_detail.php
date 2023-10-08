<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
      Detail Request Kucing
      </h2>
      <div class="page-pretitle">
        Lihat detail request iklan adopsi
      </div>
      
    </div>

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

           <?php 

            $query = "SELECT kucing.*, user.nama, user.email FROM kucing JOIN user ON user.id = kucing.user_id WHERE kucing.id = '".$_GET['id']."'";
            $kucing = mysqli_fetch_assoc(mysqli_query($koneksi, $query));

           ?>

           <div class="row">
              <div class="col-md-5">
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

                  <tr>
                    <td>Pemilik</td>
                    <th class="text-right"><?= $kucing['nama']."<br><small>".$kucing['email']."</small>" ?></th>
                  </tr>

                  <?php if($_SESSION['login_data']['akses'] == 'admin' && $kucing['status'] == 'pending'){ ?>
                    <tr class="bg-light">
                      <th colspan="2" class="text-center">
                        <a onclick="return confirm('Setujui iklan adopsi ?')" href="proses/kucing_acc.php?id=<?= $kucing['id'] ?>" class="btn btn-success">Setujui</a>
                        <a href="proses/kucing_deny.php?id=<?= $kucing['id'] ?>" onclick="return confirm('Tolak iklan adopsi ?')" class="btn btn-danger">Tolak</a>
                      </th>
                    </tr>
                  <?php }else{ ?>
                    <tr>
                      <th colspan="2" class="text-center">
                    <?php 
                        if($kucing['status'] == 'acc'){
                          echo "<span class='badge badge-success'>Disetujui</span>";
                        }else{
                          echo "<span class='badge badge-danger'>Ditolak</span>";
                        }
                      ?>
                  <?php } ?>
                      </th>
                    </tr>
                  
                </table>
              </div>

              <div class="col-md-7">
                <h3>Keterangan</h3>
                <center>
                  <img src="adopt_img/<?= $kucing['foto'] ?>" style="width: 200px; height: 200px">
                </center>

                <p class="mt-3"><?= nl2br($kucing['deskripsi']) ?></p>

                <h3>Request Adopsi</h3>
                <table class="table">
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Pengadopsi</th>
                    <th>Alasan adopsi</th>
                    <th>Status</th>
                    <th></th>
                  </tr>

                  <?php 

                  $query = mysqli_query($koneksi, "SELECT adopsi.*, user.nama, user.email, user.no_hp FROM adopsi JOIN user ON user.id = adopsi.user_id WHERE kucing_id='".$kucing['id']."'") or die(mysqli_error($koneksi));  
                  $i=1; while ($adopsi = mysqli_fetch_array($query)) { ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $adopsi['nama']."<br><small>".$adopsi['email']."<br>".$adopsi['no_hp']."</small>" ?></td>
                      <td><?= nl2br($adopsi['alasan_adopsi']) ?></td>

                      <td>
                        <?php if($adopsi['is_adoption'] == '1'){ ?>
                          <span class="badge badge-success">Terpilih</span>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($_SESSION['login_data']['akses'] == 'user'){ 
                          if($kucing['is_adopted'] == '0'){
                        ?>
                          <a href="proses/adopsi_select.php?id=<?= $adopsi['id']."&kucing_id=".$adopsi['kucing_id'] ?>" class="btn btn-success">Pilih sebagai pengadopsi</a>
                        <?php }
                        } ?>
                      </td>
                    </tr>
                  <?php }  ?>
                </table>
              </div>
            </div>
        </div>
      </div>
   </div>
</div>


<?php include 'layout/footer.php'; ?>

