<?php

require 'function.php';

//jika tidak ada id_kamar
if (!isset($_GET['id_fasilitas'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_fasilitas'];


  if (hapus($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = 'fasilitas.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = 'fasilitas.php';
    </script>";
  }


?>