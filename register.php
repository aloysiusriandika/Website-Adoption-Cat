<?php include 'layout/header.php'; ?>

<div class="flex-fill d-flex flex-column justify-content-center">
  <div class="container-tight py-6">
    <div class="text-center mb-4">
      <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
    </div>
    <form class="card card-md" action="proses/register.php" method="POST" autocomplete="off">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Daftar untuk membuat akun</h2>

        <?php
        if (isset($_SESSION['alert'])) {
          echo $_SESSION['alert'];
          unset($_SESSION['alert']);
        }
        ?>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" name="nama" required="">
        </div>

        <div class="mb-2">
          <label class="form-label">Nomor Handphone</label>
          <input type="text" class="form-control" placeholder="Masukkan Nomor Handphone" name="no_hp" id="no_hp" required>
          <div class="invalid-feedback">
            Nomor handphone harus minimal 13 digit.
          </div>
        </div>

        <script>
          document.getElementById('no_hp').addEventListener('input', function() {
            var input = this.value;
            var errorDiv = this.nextElementSibling;

            if (input.length < 13) {
              this.setCustomValidity(''); // Reset any existing validation message
              errorDiv.style.display = 'block';
              this.classList.add('is-invalid');
            } else {
              this.setCustomValidity('');
              errorDiv.style.display = 'none';
              this.classList.remove('is-invalid');
            }
          });
        </script>


        <div class="mb-2">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" placeholder="Masukkan Email" name="email" required="">
        </div>
        <div class="mb-2">
          <label class="form-label">
            Password
          </label>
          <div class="input-group input-group-flat">
            <input type="password" id="passwordInput" class="form-control" name="password" placeholder="Masukkan Password" placeholder="Password" autocomplete="off" required="">
            <span class="input-group-text">
              <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <circle cx="12" cy="12" r="2" />
                  <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                </svg>
              </a>

              <script>
                function togglePassword() {
                  var passwordInput = document.getElementById('passwordInput');
                  if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                  } else {
                    passwordInput.type = 'password';
                  }
                }
              </script>
            </span>
          </div>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'layout/footer.php'; ?>