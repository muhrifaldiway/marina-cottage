<?php

require 'function.php';
$fasilitas = query("SELECT * FROM fasilitas_kamar");

//cek apakah tombol simpan sudah ditekan

if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
      alert('data berhasil ditambahkan!');
      document.location.href = 'fasilitas.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal ditambahkan!');
      document.location.href = 'fasilitas.php';
    </script>";
  }
}


//ketika tombol cari diklik

if(isset($_POST['cari'])) {
  $fasilitas = cari($_POST['keyword']);
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
    <a class="navbar-brand">Marina Cottage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pemesanan.php">Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../kamar.php">Kamar</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="fasilitas.php">Fasilitas Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../fasilitas_umum/fasilitas_umum.php">Fasilitas Umum</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4">Halaman Admin Fasilitas Kamar Hotel</h1>
      <p class="lead">Selamat datang di halaman admin Marina Cottage. Disini Anda dapat mengelola pemesanan kamar dan mengatur kamar hotel.</p>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container mt-5">
   
   <!-- Form Tambah Pemesanan -->
    <h2 class="mb-3 mt-5">Tambah Data Fasilitas Kamar</h2>
    
        <form action="" method="POST" enctype="multipart/form-data">

    
        <div class="form-group col-md-5">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" required/>
        </div>
        <div class="form-group col-md-5">
          <label for="foto">Foto</label>
          <input type="file" name="foto" id="gambar" onchange="previewImage()"/>
          <img src="../assets/images/file/unduhan.png" width="80" style="display: block;" 
          id="preview" alt="Gambar Preview"/>
        </div>
        <div class="form-group col-md-5">
          <label for="keterangan">Keterangan</label>
          <input type="text" class="form-control" name="keterangan" id="keterangan" required/>
        </div>
        <div class="form-group col-md-5">
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </div>

      
    </form>
<br>

<form action="" method="POST">
  <div class="form-row">
  <div class="form-group col-md-3">
  <input type="text" class="form-control" name="keyword" size="40" placeholder="masukkan keyword pencarian .." 
  autocomplete="off" autofocus>
  </div>
</div>
  <button type="submit" name="cari" class="btn btn-primary">Cari!</button>

</form>

     <!-- Tab Pemesanan -->
    <h2 class="mb-3">Data Fasilitas Kamar</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th scope="col">Nama Fasilitas</th>
          <th scope="col">Foto</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Aksi</th>
        </tr>

        <?php if(empty($fasilitas)): ?>
          <tr>
            <td colspan="4"><p style="color:red; font-style: italic;">data fasilitas kamar tidak ditemukan!</p></td>
          </tr>
        <?php endif;?>

      </thead>
      <tbody>

        <?php $i = 1;
          foreach ($fasilitas as $f) : ?>
        <tr>
          <th scope="row"><?= $i++; ?></th>
          <td><?= $f['nama'];?></td>
          <td><img src="../assets/images/file/<?= $f['foto'];?>" width="50px"></td>
          <td><?= $f['keterangan'];?></td>
          <td>
            <a href="ubah.php?id_fasilitas=<?=$f['id_fasilitas'];?>" class="btn btn-success btn-sm" name="ubah">Ubah</a>
            <a href="hapus.php?id_fasilitas=<?=$f['id_fasilitas'];?>" onclick="return confirm
            ('apakah anda yakin?');" class="btn btn-danger btn-sm" name="hapus">Hapus</a>
          </td>
          
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </main>

 
  <!-- Footer -->
  <footer class="bg-light py-3 mt-10">
          
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="../assets/js/bootstrap.js"></script>
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