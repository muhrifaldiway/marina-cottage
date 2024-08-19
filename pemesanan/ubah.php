<?php

require 'function.php';

//jika tidak ada id_kamar
if (!isset($_GET['id_pemesanan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_pemesanan'];

// query kamar berdasarkan id_kamar
$pemesanan = query("SELECT * FROM pemesanan WHERE id_pemesanan = $id");
$kamar = query("SELECT * FROM kamar");



//menambahkan data dan mengirimkan data ke function.php yang ada didalam folder pemesanan
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
        alert('data berhasil diubah!');
        document.location.href = '../admin.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../admin.php';
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
   
   <!-- Form Tambah Pemesanan -->
    <h2 class="mb-3 mt-5">Tambah Pemesanan</h2>

    <?php foreach ($pemesanan as $p) : ?>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <input hidden name="id_pemesanan" value="<?= $p['id_pemesanan'];?>">
        <div class="form-group col-md-3">
          <label for="tgl_cekin">Tanggal Cek In</label>
          <input value="<?= $p['tgl_cekin'];?>" type="date" class="form-control" id="inputTanggalMasuk" name="tgl_cekin"/>
        </div>
        <div class="form-group col-md-2">
          <label for="tgl_cekout">Tanggal Cek Out</label>
          <input value="<?= $p['tgl_cekout'];?>" type="date" class="form-control" id="inputTanggalKeluar" name="tgl_cekout"/>
        </div>
        <div class="form-group col-md-5">
          <label for="jumlah_kamar">Jumlah Kamar</label>
          <input value="<?= $p['jumlah_kamar'];?>" type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar"/>
        </div>
      </div>  
    <div class="form-row">
        <div class="form-group col-md-5">
          <label for="nama">Nama Pemesan</label>
          <input value="<?= $p['nama'];?>" type="text" class="form-control" id="nama" name="nama"/>
        </div>
        <div class="form-group col-md-5">
          <label for="email">Email</label>
          <input value="<?= $p['email'];?>" type="text" class="form-control" id="email" name="email"/>
        </div>
        <div class="form-group col-md-5">
          <label for="telepon">No Telepon</label>
          <input value="<?= $p['telepon'];?>" type="number" class="form-control" id="telepon" name="telepon"/>
        </div>
        <div class="form-group col-md-5">
          <label for="kamar_id">Kamar</label>
          <select id="kamar_id" class="form-control" name="kamar_id">
            <option>Pilih...</option>
            <?php foreach ($kamar as $k) :?>
            
              <option value="<?= $k['id_kamar'];?>" selected><?= $k['nama'];?></option>
             
            <?php endforeach ;?>
          
          </select>
        </div>
        <div class="form-group col-md-5">
          <label for="status">Status</label>
          <select id="status" class="form-control" name="status">
            
              <option value="<?= $p['status'];?>" selected><?= $p['status'];?></option>
              <option value="diterima">diterima</option>
             
           
          </select>
        </div>
        <?php endforeach;?>
      </div>
     
      <button type="submit" class="btn btn-success" name="ubah">Ubah</button>

      <?php
            $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../pemesanan.php';
        ?>
      <a href="<?=$url?>" type="button" class="btn btn-dark">Kembali</a> 

    </form>

<br>
    


  </main>

 
  <!-- Footer -->
  <footer class="bg-light py-3 mt-10">
          
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="assets/js/bootstrap.js"></script>
</body>
</html>