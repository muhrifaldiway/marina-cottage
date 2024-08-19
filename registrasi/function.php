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

function registrasi($data)
	{
		$conn = koneksi();

		$nama_petugas = htmlspecialchars($data['nama_petugas']);
		$email = htmlspecialchars(strtolower($data['email']));
		$password = htmlspecialchars($data['password']);
		$telepon = htmlspecialchars($data['telepon']);
		$role_id = htmlspecialchars($data['role_id']);


		//jika username sudah ada

		if (query("SELECT * FROM user WHERE email = '$email'")) {
			echo"<script>
					alert('email sudah ada !');
					document.location.href = 'registrasi.php';
					</script>";
			return false;
		}

		// jika username & password sudah sesuai 
		// enskripsi password
		//$password_baru = password_hash($password, PASSWORD_DEFAULT);
		//insert ke tabel user
		$query = "INSERT INTO user
					VALUES
				  (null, '$nama_petugas','$email','$password','$telepon','$role_id')
				";
		mysqli_query($conn, $query) or die(mysqli_error($conn));
		return mysqli_affected_rows($conn);
	}


