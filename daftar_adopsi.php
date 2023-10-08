<?php include 'layout/header.php'; ?>

<div class="page-header d-print-none">
  <div class="row align-items-center">
    <div class="col">
      <!-- Page pre-title -->
      <h2 class="page-title">
      Daftar Adopsi
      </h2>
      <div class="page-pretitle">
        Lihat daftar request adopsi kucing
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
                <th>Alasan Adopsi</th>
              </tr>
            </thead>
            <tbody>
              <?php 

                   $query = mysqli_query($koneksi, "SELECT * FROM adopsi JOIN kucing ON kucing.id = adopsi.kucing_id JOIN user ON user.id = kucing.user_id WHERE adopsi.user_id='".$_SESSION['login_data']['id']."'") or die(mysqli_error($koneksi));
                
               

                $i = 1;
                while ($kucing = mysqli_fetch_array($query)){ ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="adopt_img/<?= $kucing['foto'] ?>" style="width: 100px; height: 100px"></td>
                    <td><?= $kucing['nama_kucing'] ?></td>
                    <td><?= $kucing['jenis'] ?></td>
                    <td><?= $kucing['umur'] ?></td>
                    <td><?= $kucing['jenis_kelamin'] ?></td>
                    <td><?php 
                        if($kucing['is_adopted'] == '0'){
                          echo "<span class='badge badge-info'>Menunggu konfirmasi pemilik</span>";
                        }else{
                          if($kucing['is_adoption'] == '1'){
                            echo "<span class='badge badge-danger'>Terpilih menjadi pengadopsi</span>";
                          }else{
                            echo "<span class='badge badge-danger'>Adopsi diserahkan kepada orang lain</span>";
                          }
                        }
                      ?></td>
                    <td>
                      <?= $kucing['alasan_adopsi'] ?>
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

