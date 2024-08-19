<?php

require 'pemesanan/function.php';

$pemesanan = query("SELECT * FROM pemesanan");
$kamar = query("SELECT * FROM kamar");


//menambahkan data dan mengirimkan data ke function.php yang ada didalam folder pemesanan
if (isset($_POST['pesan'])) {
  if (pesan($_POST) > 0) {
    echo "<script>
      alert('Selamat pemesanan hotel anda berhasil!');
      document.location.href = 'admin.php';
    </script>";
  }else {
    echo "<script>
      alert('Pemesanan anda gagal!');
      document.location.href = 'admin.php';
    </script>";
  }
}


if(isset($_POST['cari'])) {
  $pemesanan = cari($_POST['keyword']);
}
?>



<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">

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
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="pemesanan.php">Pemesanan</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="kamar.php">Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fasilitas_kamar/fasilitas.php">Fasilitas Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fasilitas_umum/fasilitas_umum.php">Fasilitas Umum</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4">Halaman Admin Hotel</h1>
      <p class="lead">Selamat datang di halaman admin Hotel XYZ. Disini Anda dapat mengelola pemesanan kamar dan mengatur kamar hotel.</p>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container mt-5">
   
   <!-- Form Tambah Pemesanan -->
    <h2 class="mb-3 mt-5">Tambah Pemesanan</h2>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-3">
          <label for="tgl_cekin">Tanggal Cek In</label>
          <input type="date" class="form-control" id="inputTanggalMasuk" name="tgl_cekin"/>
        </div>
        <div class="form-group col-md-2">
          <label for="tgl_cekout">Tanggal Cek Out</label>
          <input type="date" class="form-control" id="inputTanggalKeluar" name="tgl_cekout"/>
        </div>
        <div class="form-group col-md-5">
          <label for="jumlah_kamar">Jumlah Kamar</label>
          <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar"/>
        </div>
      </div>  
    <div class="form-row">
        <div class="form-group col-md-5">
          <label for="nama">Nama Pemesan</label>
          <input type="text" class="form-control" id="nama" name="nama"/>
        </div>
        <div class="form-group col-md-5">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email"/>
        </div>
        <div class="form-group col-md-5">
          <label for="telepon">No Telepon</label>
          <input type="number" class="form-control" id="telepon" name="telepon"/>
        </div>
        <div class="form-group col-md-5">
          <label for="kamar_id">Kamar</label>
          <select id="kamar_id" class="form-control" name="kamar_id">
            <option>Pilih...</option>
            <?php foreach ($kamar as $k) :?>
            
              <option value="<?= $k['id_kamar'];?>"><?= $k['nama'];?></option>
             
            <?php endforeach ;?>
          
          </select>
        </div>
        <div class="form-group col-md-5" hidden>
          <label for="status">Status</label>
          <select id="status" class="form-control" name="status">
            
              <option value="pending" selected>Pending</option>
             
           
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="pesan">Konfirmasi Pemesanan</button>
    </form>

<br>

<form action="" method="POST">
  <div class="form-row">
  <div class="form-group col-md-3">
  <input type="text" class="form-control" name="keyword" size="40" placeholder="masukkan keyword pencarian .." 
  autocomplete="off">
  </div>
  <div class="form-group col-md-3">
  <input type="date" class="form-control" name="keyword" size="40">
  </div>
  
</div>
  <button type="submit" name="cari" class="btn btn-primary">Cari!</button>

</form>
     <!-- Tab Pemesanan -->
    <h2 class="mb-3">Pemesanan</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal Cek In</th>
          <th scope="col">Tanggal Cek Out</th>
          <th scope="col">Aksi</th>
        </tr>
        <?php if(empty($pemesanan)): ?>
          <tr>
            <td colspan="4"><p style="color:red; font-style: italic;">data anda tidak ditemukan!</p></td>
          </tr>
        <?php endif;?>
      </thead>
      <tbody>

      <?php $no = 1;
          foreach ($pemesanan as $p) : ?>
          <?php 
          
          $tanggal1 = date("d-m-Y", strtotime($p['tgl_cekin']));
          $tanggal2 = date("d-m-Y", strtotime($p['tgl_cekout']));
          
          ;?>
        <tr>
          <th scope="row"><?= $no;?></th>
          <td><?= $p['nama'];?></td>
          <td><?= $tanggal1;?></td>
          <td><?= $tanggal2;?></td>
          
          <td>
            <a href="pemesanan/detail.php?id_pemesanan=<?=$p['id_pemesanan'];?>" 
            class="btn btn-primary btn-sm" name="ubah">Lihat Pemesanan</a>

            <a href="pemesanan/hapus.php?id_pemesanan=<?=$p['id_pemesanan'];?>" onclick="return confirm
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

<script src="assets/js/bootstrap.js"></script>
</body>
</html>