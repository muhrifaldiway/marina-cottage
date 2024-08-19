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


function pesan($data){

	$conn = koneksi();

	$tgl_cekin = htmlspecialchars($data['tgl_cekin']);
	$tgl_cekout = htmlspecialchars($data['tgl_cekout']);
	$jumlah_kamar = htmlspecialchars($data['jumlah_kamar']);
	$nama = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$telepon = htmlspecialchars($data['telepon']);
	$kamar_id = htmlspecialchars($data['kamar_id']);
	$status = htmlspecialchars($data['status']);
	//$foto = htmlspecialchars($data['foto']);
	//upload gambar

	//$foto = upload();
	

	$query = "INSERT INTO
				pemesanan
			  VALUES
			  (null, '$tgl_cekin','$tgl_cekout','$jumlah_kamar','$nama','$email','$telepon','$kamar_id','$status'); 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function ubah($data){

	$conn = koneksi();

	$id = $data['id_pemesanan'];
	$tgl_cekin = htmlspecialchars($data['tgl_cekin']);
	$tgl_cekout = htmlspecialchars($data['tgl_cekout']);
	$jumlah_kamar = htmlspecialchars($data['jumlah_kamar']);
	$nama = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$telepon = htmlspecialchars($data['telepon']);
	$kamar_id = $data['kamar_id'];
	$status = htmlspecialchars($data['status']);
	

	$query = "UPDATE pemesanan SET

			  tgl_cekin = '$tgl_cekin',
			  tgl_cekout = '$tgl_cekout',
			  jumlah_kamar = '$jumlah_kamar',
			  nama = '$nama',
			  email = '$email',
			  telepon = '$telepon',
			  kamar_id = '$kamar_id',
			  status = '$status'
			 
			  WHERE id_pemesanan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}



function hapus($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM pemesanan WHERE id_pemesanan = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function detail($data){

	$conn = koneksi();

	$id = $data['id_pemesanan'];
	$tgl_cekin = htmlspecialchars($data['tgl_cekin']);
	$tgl_cekout = htmlspecialchars($data['tgl_cekout']);
	$jumlah_kamar = htmlspecialchars($data['jumlah_kamar']);
	$nama = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$kamar_id = htmlspecialchars($data['kamar_id']);

	$query = "UPDATE pemesanan SET

			  tgl_cekin = '$tgl_cekin',
			  tgl_cekout = '$tgl_cekout',
			  jumlah_kamar = '$jumlah_kamar',
			  nama = '$nama',
			  email = '$email',
			  kamar_id = '$kamar_id'
			  
			  WHERE id_pemesanan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$conn = koneksi();

	$query = "SELECT * FROM pemesanan
				WHERE 
				nama LIKE '%$keyword%' OR
				tgl_cekin LIKE '%$keyword%'
				";

	$result = mysqli_query($conn, $query);

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 
}
