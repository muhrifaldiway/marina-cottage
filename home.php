<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
require 'pemesanan/function.php';

// query pemesanan berdasarkan id_pemesanan dan mengambil data dari penggabungan 2 tabel yaitu data harga
// di tabel kamar dan jumlah kamar di tabel pemesanan
$kamar = query("SELECT * FROM kamar");
$fasilitas = query("SELECT * FROM fasilitas_kamar");
$fasilitas_umum = query("SELECT * FROM fasilitas_umum");



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

  <title>Halaman Home</title>
</head>
<body>
  <!-- Navigasi -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Marina Cottage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pesan.php">Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recepsionis.php">Recepsionis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
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
      <h1 class="display-4">Marina Cottage</h1>
      <p class="lead">Selamat datang di Marina Cottage, tempat yang nyaman dan terbaik untuk menginap di kota kami.</p>
      <a href="#kamar" class="btn btn-lg btn-success">Lihat Kamar</a>
    </div>
  </header>

  
  <!-- Konten Utama -->
  <main class="container mt-5">
    <!-- Fitur-Fitur -->
    <h2 id="kamar">Kamar</h2>
    <div class="row mt-3">
    <?php foreach($kamar as $k) :?>
      <div class="col-md-4">
          
        <div class="card">
          <img src="assets/images/file/<?= $k['foto'];?>" class="card-img-top" alt="Gambar Kolam Renang">
          <div class="card-body">
            <h5 class="card-title"><?= $k['nama'];?></h5>
            <h4 class="text-primary"><?php echo 'Rp. ' . number_format($k['harga'], 3); ?></h4>
          </div>
        </div>
        
</div>
<?php endforeach;?>
    </div>
<br>

    <!-- Fitur-Fitur -->
    <h2>Fasilitas Umum</h2>
    <div class="row mt-3">
    <?php foreach($fasilitas_umum as $fu) :?>
      <div class="col-md-4">
          
        <div class="card">
          <img src="assets/images/file/<?= $fu['foto'];?>" class="card-img-top" alt="Gambar Kolam Renang">
          <div class="card-body">
            <h5 class="card-title"><?= $fu['nama'];?></h5>
            <p class="card-text"><?= $fu['keterangan'];?></p>
          </div>
        </div>
        
</div>
<?php endforeach;?>
    </div>
<br>

    <!-- Fasilitas kamar -->
    <h2>Fasilitas Kamar</h2>
    <div class="row mt-3">
    <?php foreach($fasilitas as $f) :?>
      <div class="col-md-4">
        <div class="card">
          <img src="assets/images/file/<?= $f['foto'];?>" class="card-img-top" alt="Gambar Kolam Renang">
          <div class="card-body">
            <h5 class="card-title"><?= $f['nama'];?></h5>
            <p class="card-text"><?= $f['keterangan'];?></p>
          </div>
        </div>
      </div>
     <?php endforeach;?>
      </div>
    </div>


    <!-- Galeri -->
    

  </main>

  <!-- Footer -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Tentang Kami</h5>
          <p>Marina Cottage adalah hotel bintang 5 yang terletak di kota XYZ. Kami menyediakan fasilitas-fasilitas terbaik dan layanan yang ramah untuk para tamu kami.</p>
        </div>
        <div class="col-md-4">
          <h5>Navigasi</h5>
          <ul class="list-unstyled">
            <li><a href="home.php">Home</a></li>
            <li><a href="pesan.php">Pemesanan</a></li>
            <li><a href="admin.php">Admin</a></li>
            
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Kontak</h5>
          <ul class="list-unstyled">
            <li>Alamat: Jalan ABC No. 123, Kota XYZ</li>
            <li>Telepon: (123) 456-7890</li>
            <li>Email: info@hotelxyz.com</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>