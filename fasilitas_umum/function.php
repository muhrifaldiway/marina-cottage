<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'hotel');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}


function upload(){

	//var_dump($_FILES);
	//die;

	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$ukuran_file = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmp_file = $_FILES['foto']['tmp_name'];

	// ketika tidak ada gambar yang dipilih

	if ($error == 4) {
		
		return 'unduhan.png';
	}

	//cek ekstenti file
	$daftar_foto = ['jpg','jpeg','png'];
	$ekstenti_file = explode('.', $nama_file);
	$ekstenti_file = strtolower(end($ekstenti_file));
	if (!in_array($ekstenti_file, $daftar_foto)) {
		echo "<script>
	      alert('yang anda pilih bukan foto!');
	      document.location.href = 'fasilitas_umum.php';
	    </script>";
		return false;
	}

	//cek ukuran file

	if ($ukuran_file > 2000000){
		echo "<script>
	      alert('ukuran file besar!');
	      document.location.href = 'fasilitas_umum.php';
	    </script>";
		return false;
	}

	//upload file
	//generate nama_file
	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstenti_file;
	move_uploaded_file($tmp_file, '../assets/images/file/'. $nama_file_baru);

	return $nama_file_baru;
}


function tambah($data){

	$conn = koneksi();

	$nama = htmlspecialchars($data['nama']);
	$keterangan = htmlspecialchars($data['keterangan']);
	//$foto = htmlspecialchars($data['foto']);
	//upload gambar
	$foto = upload();
	
	

	$query = "INSERT INTO
				fasilitas_umum
			  VALUES
			  (null, '$nama','$foto','$keterangan'); 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function hapus($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM fasilitas_umum WHERE id_fumum = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function ubah($data){

	$conn = koneksi();

	$id = $data['id_fumum'];
	$nama = htmlspecialchars($data['nama']);
	$foto_lama = htmlspecialchars($data['foto_lama']);
	$keterangan = htmlspecialchars($data['keterangan']);

	$foto = upload();
	if (!$foto) {
		return false;
	}

	if ($foto == 'unduhan.png'){
		
		$foto = $foto_lama;
	}
	

	$query = "UPDATE fasilitas_umum SET
			  nama = '$nama',
			  foto = '$foto',
			  keterangan = '$keterangan'
			  WHERE id_fumum = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$conn = koneksi();

	$query = "SELECT * FROM fasilitas_umum
				WHERE 
				nama LIKE '%$keyword%'
				";

	$result = mysqli_query($conn, $query);

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 
}