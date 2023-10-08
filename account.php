<?php include 'layout/header.php'; ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header"><h2>Akun</h2></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <?php 
              if(isset($_SESSION['alert'])){
                 echo $_SESSION['alert'];
                 unset($_SESSION['alert']);
              }
           ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h4>Informasi Profil</h4>
            <form method="POST" action="proses/ubah_profile.php">
              <div class="form-group">
                <label>Email</label>
                <input type="text" disabled="" class="form-control mt-2" value="<?= $_SESSION['login_data']['email'] ?>">
              </div>

              <div class="form-group mt-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" autocomplete="off" class="form-control mt-2" value="<?= $_SESSION['login_data']['nama'] ?>">
              </div>

              <div class="form-group mt-3">
                <label>Nomor Handphone</label>
                <input type="text" autocomplete="off" name="no_hp" class="form-control mt-2" value="<?= $_SESSION['login_data']['no_hp'] ?>">
              </div>

              <div class="form-group mt-3">
                <button class="btn btn-warning">UBAH PROFIL</button>
              </div>
            </form>

          </div>

          <div class="col-md-6">
            <h4>Ubah Password</h4>
            <form method="POST" action="proses/ubah_password.php">
              <div class="form-group mt-2">
                <label>Password</label>
                <input type="password" name="password" placeholder="Ketikkan Password Baru" required="" class="form-control mt-2">
              </div>

              <div class="form-group mt-3">
                  <button class="btn btn-warning">GANTI PASSWORD</button>
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>