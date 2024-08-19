<?php

require 'registrasi/function.php';

if (isset($_POST['registrasi'])) {
  if (registrasi($_POST) > 0) {
    echo"<script>
					alert('user baru berhasil ditambahkan. silahkan login !');
					document.location.href = 'login.php';
					</script>";
  } else {
    echo "user gagal ditambahkan !";
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="text-center text-white">Registration</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
            <div class="form-group">
                <label for="nama_petugas">Nama Petugas</label>
                <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" autofocus required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="number" class="form-control" name="telepon" id="telepon" required>
              </div>
              <div class="form-group">
                <label for="role_id">Role_Id</label>
                <select name="role_id" id="role_id" class="form-select" required>
                    <option>Silahkan Pilih !</option>
                    <option value="1">Admin</option>
                    <option value="2">Recepsionis</option>
                </select>
              </div>
              <br>
              <a class="text-primary">sudah memiliki akun silahkan <b>Login</b> !</a>
              <br><br>
              <button type="submit" name="registrasi" class="btn btn-primary">Registrasi</button>
              <a href="login.php" class="btn btn-secondary">Login</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>