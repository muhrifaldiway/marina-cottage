<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'pemesanan/function.php';

// query pemesanan berdasarkan id_pemesanan dan mengambil data dari penggabungan 2 tabel yaitu data harga
// di tabel kamar dan jumlah kamar di tabel pemesanan
$pemesanan = query("SELECT pemesanan.id_pemesanan, pemesanan.tgl_cekin, pemesanan.tgl_cekout, 
pemesanan.jumlah_kamar, pemesanan.nama, pemesanan.email, pemesanan.telepon, kamar.harga, pemesanan.status 
FROM pemesanan JOIN kamar ON pemesanan.kamar_id = kamar.id_kamar");




//ketika tombol cari diklik

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
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
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
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
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
   
   <!-- Form Tambah Kamar -->
    <h2 class="mb-3 mt-5">Data Pemesanan Kamar</h2>
    
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
        <button type="submit" name="cari" class="btn btn-primary">Cari!</button><br><br>
    </form>
    <?php $no = 1;
          foreach ($pemesanan as $p) : ?>
          <?php 
          
          $tanggal1 = date("d-m-Y", strtotime($p['tgl_cekin']));
          $tanggal2 = date("d-m-Y", strtotime($p['tgl_cekout']));
          
          ;?>
   

<table class="table table-bordered">
      <thead>
        <tr>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">No</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Nama</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Email</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Telepon</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Tanggal Cek In</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Tanggal Cek Out</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Jumlah Kamar</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Status</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Aksi</th>
        </tr>
        <?php if(empty($pemesanan)): ?>
          <tr>
            <td colspan="4"><p style="color:red; font-style: italic;">data anda tidak ditemukan!</p></td>
          </tr>
        <?php endif;?>
      </thead>
      <tbody>
            
        <tr>
          <th scope="row"><?= $no;?></th>
          <td><?= $p['nama'];?></td>
          <td><?= $p['email'];?></td>
          <td><?= $p['telepon'];?></td>
          <td><?= $tanggal1;?></td>
          <td><?= $tanggal2;?></td>
          <td><?= $p['jumlah_kamar'];?></td>
          
          <td><span class="badge badge-pill badge-info text-white"><?= $p['status'];?></span></td>
          <td>
        
            <a href="pemesanan/ubah.php?id_pemesanan=<?=$p['id_pemesanan'];?>" type="button" class="badge badge-pill badge-success text-white" 
            >Ubah</a> 
            <hr>
            <a href="pemesanan/detail.php?id_pemesanan=<?=$p['id_pemesanan'];?>" 
            class="badge badge-pill badge-primary" name="ubah">Lihat Pemesanan</a>
            <hr>
            <a href="javascript:window.print()" type="button" class="badge badge-pill badge-warning text-white" 
            >Cetak</a> 

          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      
        <tr>
         
    </table>



<script src="assets/js/bootstrap.js"></script>
</body>
</html>