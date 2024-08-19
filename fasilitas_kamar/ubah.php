<?php

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['id_fasilitas'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_fasilitas'];

// query kamar berdasarkan id_kamar
$fasilitas = query("SELECT * FROM fasilitas_kamar WHERE id_fasilitas = $id");

if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
      alert('data berhasil diubah!');
      document.location.href = 'fasilitas.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal diubah!');
      document.location.href = 'fasilitas.php';
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

	<?php foreach ($fasilitas as $fk) : ?>
    <form action="" method="POST" enctype="multipart/form-data">
    	<input type="hidden" value="<?= $fk['id_fasilitas'];?>" name="id_fasilitas">
  
        <div class="form-group col-md-5">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" value="<?=$fk['nama'];?>">
        </div>
        <div class="form-group col-md-5">
          <label for="foto">foto</label>
          <input type="hidden" name="foto_lama" value="<?=$fk['foto'];?>">
          <input type="file" name="foto" id="gambar" onchange="previewImage()"/>
          <img src="../assets/images/file/<?=$fk['foto'];?>" width="80" style="display: block;" 
          id="preview" alt="Gambar Preview"/>
        </div>

        <div class="form-group col-md-5">
        <label for="foto">Keterangan</label>
          <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?=$fk['keterangan'];?>">
        </div>
        <?php endforeach; ?> 
      
        <div class="form-group col-md-5">
      <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
      <?php
        $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../kamar.php';
      ?>
      <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> 
      </div>
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