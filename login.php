<?php include 'layout/header.php'; ?>

<div class="flex-fill d-flex flex-column justify-content-center">
  <div class="container-tight py-6">
    <div class="text-center mb-4">
      <a href="."><img src="./static/logo.svg" height="36" alt=""></a>
    </div>
    <form class="card card-md" action="proses/login.php" method="POST" autocomplete="off">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Masuk untuk akses akun</h2>

        <?php
        if (isset($_SESSION['alert'])) {
          echo $_SESSION['alert'];
          unset($_SESSION['alert']);
        }
        ?>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Masukkan email" required="">
        </div>
        <div class="mb-2">
          <label class="form-label">
            Password
          </label>
          <div class="input-group input-group-flat">
            <input type="password" id="passwordInput" class="form-control" name="password" placeholder="Masukkan password" placeholder="Password" autocomplete="off" required="">
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
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'layout/footer.php'; ?>