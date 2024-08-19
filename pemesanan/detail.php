<?php

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['id_pemesanan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_pemesanan'];

// query pemesanan berdasarkan id_pemesanan dan mengambil data dari penggabungan 2 tabel yaitu data harga
// di tabel kamar dan jumlah kamar di tabel pemesanan

$pemesanan = query("SELECT pemesanan.tgl_cekin, pemesanan.tgl_cekout, pemesanan.jumlah_kamar, pemesanan.nama, pemesanan.email, pemesanan.telepon, kamar.harga, pemesanan.status 
FROM pemesanan JOIN kamar ON pemesanan.kamar_id = kamar.id_kamar WHERE id_pemesanan = $id;");





if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
      alert('data berhasil diubah!');
      document.location.href = 'pemesanan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal diubah!');
      document.location.href = 'pemesanan.php';
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

  <title>Halaman Admin Detail Pemesanan Hotel</title>
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4">Halaman Detail Pemesanan Kamar Hotel</h1>
      <p class="lead">Selamat datang di halaman admin Hotel XYZ. Disini Anda dapat mengelola pemesanan kamar dan mengatur kamar hotel.</p>
    </div>
  </header>


  <!-- Konten Utama -->
  <main class="container mt-5">
   
   <!-- Form Tambah Kamar -->
    <h2 class="mb-3 mt-5">Data Pemesanan Kamar</h2>

	
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
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Harga Kamar</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Total harga</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Status</th>
          <th style="vertical-align: bottom; rotate: -90;" scope="col">Aksi</th>

        </tr>
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
          <td>Rp.<?=number_format($p['harga'], 3, ",", ".");?></td>
          <?php 
            $total_harga = $p['jumlah_kamar'] * $p['harga'];
          ;?>
          <td>Rp.<?= number_format( $total_harga, 3, ",", ".");?></td>
          <td><span class="badge badge-pill badge-warning text-white"><?= $p['status'];?></span></td>
          <td>

             
        <a href="javascript:window.print()" type="button" class="badge badge-pill badge-primary text-white" 
        >Cetak</a> 
          <br>
            <?php
              $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../pemesanan.php';
            ?>
        
        <a href="<?=$url?>" type="button" class="badge badge-pill badge-dark text-white">Kembali</a> 

          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>



<script src="assets/js/bootstrap.js"></script>
</body>
</html>