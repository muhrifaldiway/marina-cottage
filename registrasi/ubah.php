<?php

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['id_kamar'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_kamar'];

// query kamar berdasarkan id_kamar
$kamar = query("SELECT * FROM kamar WHERE id_kamar = $id");


if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
      alert('data berhasil diubah!');
      document.location.href = '../kamar.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal diubah!');
      document.location.href = '../kamar.php';
    </script>";
  }
}


?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <title>Halaman Admin Hotel</title>
</head>
<body>
  <!-- Navigasi -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hotel XYZ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kamar.php">Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fasilitas-kamar.php">Fasilitas Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fasilitas-umum.php">Fasilitas Umum</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4">Halaman Admin Kamar Hotel</h1>
      <p class="lead">Selamat datang di halaman admin Hotel XYZ. Disini Anda dapat mengelola pemesanan kamar dan mengatur kamar hotel.</p>
    </div>
  </header>


  <!-- Konten Utama -->
  <main class="container mt-5">
   
   <!-- Form Tambah Kamar -->
    <h2 class="mb-3 mt-5">Ubah Data Kamar</h2>

	<?php foreach ($kamar as $km) : ?>
    <form action="" method="POST" enctype="multipart/form-data">
    	<input type="hidden" value="<?= $km['id_kamar'];?>" name="id_kamar">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" value="<?=$km['nama'];?>">
        </div>
        <div class="form-group col-md-6">
          <label for="harga">Harga</label>
          <input type="text" class="form-control" name="harga" id="harga" value="<?=$km['harga'];?>">
        </div>
        <div class="form-group col-md-6">
          <label for="foto">foto</label>
          <input type="hidden" name="foto_lama" value="<?=$km['foto'];?>">
          <input type="file" name="foto" id="gambar" onchange="previewImage()"/>
          <img src="../assets/images/file/<?=$km['foto'];?>" width="80" style="display: block;" 
          id="preview" alt="Gambar Preview"/>
        </div>
	<?php endforeach; ?> 

      </div>
      <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
      <?php
        $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../kamar.php';
      ?>
      <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> 
    </form>
   
  </main>

 
  <!-- Footer -->
  <footer class="bg-light py-3 mt-10">
          
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="assets/js/bootstrap.js"></script>
<script>
      function previewImage() {
        var preview = document.getElementById('preview');
        var file = document.getElementById('gambar').files[0];
        var reader = new FileReader();
        
        reader.onloadend = function() {
          preview.src = reader.result;
        }
        
        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
        }
      }
    </script>
</body>
</html>