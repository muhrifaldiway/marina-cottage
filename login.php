<?php
session_start();

  
if (isset($_SESSION['login'])) {
    header("Location: home.php");
    exit;
}


require 'login/function.php';

//ketika tombol login di tekan

if (isset($_POST['login'])){
    $login = login($_POST);
}


?>


<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="">
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="text-center text-white">Login</h3>
          </div>
          <div class="card-body">
          <?php if(isset($login['error'])): ?>
            <div class="alert alert-danger alert-dismissible">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?= $login['pesan'] ?></strong> Silahkan Login Kembali!.
            </div>
            
              
            <?php endif; ?>
           
            
            <form action="" method="POST">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" autofocus autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <br>
              <button type="submit" name="login" class="btn btn-primary">Login</button>
              <a href="registrasi.php" class="btn btn-secondary">Registration</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>