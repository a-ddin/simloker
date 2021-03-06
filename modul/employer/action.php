<?php
	if ( isset($_POST['save']) ) 
	{
		$allowExt 			= array( 'png', 'jpg', 'jpeg' );

		$fileName 			= $_FILES['logo']['name'];
		$fileExt			= strtolower(end(explode('.', $fileName)));
		$fileSize			= $_FILES['logo']['size'];
		$fileTemp 			= $_FILES['logo']['tmp_name'];

		$v_nama_perusahaan 	= $_POST['nama_perusahaan'];
		$v_alamat			= $_POST['alamat'];
		$v_kota				= $_POST['kota'];
		$v_prov				= $_POST['prov'];
		$v_no_telp			= $_POST['no_telp'];

		$v_ket_perusahaan	= $_POST['ket_perusahaan'];

		$upload_dir 		= "dist/images/logo/";
		$logo 				= basename ($fileName);
		$v_logo 			= str_replace(' ','_',$logo);

		if ( in_array( $fileExt, $allowExt ) === TRUE ) 
		{
			if ( $fileSize < 1044070 ) 
			{
				$v_id_perusahaan = $_POST['id_perusahaan'];
				$sqlCek = "SELECT *
							FROM tb_perusahaan 
						WHERE nama_perusahaan = '$v_nama_perusahaan' ";

		    	$result = $conn->query($sqlCek);
			    
			    if ($result->num_rows > 0) 
			    {
			        echo '<script>alert("nama perusahaan sudah terdaftar"); </script>';
 					echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';
			    } else {

					if ( move_uploaded_file( $fileTemp,$upload_dir.$v_logo) ) 
					{
						$sql = "INSERT INTO tb_perusahaan 
											(
											nama_perusahaan, 
											alamat, 
											no_telp,
											logo,
											ket_perusahaan,
											tgl_daftar) VALUES 
													(
													'$v_nama_perusahaan',
													'$v_alamat',
													'$v_no_telp',
													'$v_logo',
													'$v_ket_perusahaan',
													NOW()
													)";

						if ( $conn->query($sql) === TRUE ) {
							// echo "berhasil simpan";
							echo '<script>alert("data berhasil disimpan"); </script>';
	 						echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';
						} else {
							echo "terjadi kesalahan fatal" .$sql.' <br> ' .$conn->error;
						}
					} else {
						echo '<script>alert("gagal upload file"); </script>';
						echo '<meta http-equiv="refresh" content="0;URL=?p=employer.add">';
					}
				}
			} else {
				echo '<script>alert("ukuran file maks 1 mb"); </script>';
				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.add">';
			}
		} else {
			echo '<script>alert("ekstensi file tidak diijinkan"); </script>';
			echo '<meta http-equiv="refresh" content="0;URL=?p=employer.add">';
		}
		$conn->close();
	}


	if ( isset($_POST['edit']) ) 
	{
		$getId		= $_GET['user_id'];
		$v_user_id	= $_POST['user_id'];
		$cek   		= "SELECT * FROM tb_perusahaan WHERE user_id = '".$getId."' "; 
		$res    	= $conn->query($cek);
		$data   	= $res->fetch_array();

		$allowExt 			= array( 'png', 'jpg', 'jpeg' );

		$fileName 			= $_FILES['logo']['name'];
		$fileExt			= strtolower(end(explode('.', $fileName)));
		$fileSize			= $_FILES['logo']['size'];
		$fileTemp 			= $_FILES['logo']['tmp_name'];

		$v_nama_perusahaan 	= $_POST['nama_perusahaan'];
		$v_alamat			= $_POST['alamat'];
		$v_kota				= $_POST['kota'];
		$v_prov				= $_POST['prov'];
		$v_no_telp			= $_POST['no_telp'];

		$v_ket_perusahaan	= $_POST['ket_perusahaan'];

		$upload_dir 		= "dist/images/logo/";
		$logo 				= basename ($fileName);
		$v_logo 			= str_replace(' ','_',$logo);

		// jika logo tidak diubah 
		if ( empty($fileTemp) ) 
		{
			$sql = "UPDATE tb_perusahaan 
							SET 
								nama_perusahaan = '$v_nama_perusahaan',
								alamat 			= '$v_alamat',
								no_telp 		= '$v_no_telp',
								ket_perusahaan 	= '$v_ket_perusahaan' 
							WHERE user_id 		= '".$v_user_id."' ";

			if ($conn->query($sql) === TRUE) {

				echo '<script>alert("data berhasil diperbarui"); </script>';
 				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.profil">';	    	
			}else{
				echo "terjadi kesalahan fatal" .$sql.' <br> ' .$conn->error;
			}
		}

		// jika logo diubah
		else if( !empty($fileTemp) ) 
		{

		if ( in_array( $fileExt, $allowExt ) === TRUE ) 
		{
			if ( $fileSize < 1044070 ) 
			{
				// $sqlCek = "SELECT * 
				// 			FROM tb_perusahaan 
				// 		WHERE nama_perusahaan = '$v_nama_perusahaan' ";

		  //   	$result = $conn->query($sqlCek);
			    
			 //    if ($result->num_rows > 0) 
			 //    {
			 //        echo '<script>alert("nama perusahaan sudah terdaftar"); </script>';
 			// 		echo '<meta http-equiv="refresh" content="0;URL=?p=perusahaan.profil">';
			 //    } else {

					if ( move_uploaded_file( $fileTemp,$upload_dir.$v_logo) ) 
					{
						unlink($upload_dir.$data['logo']);

						$sql = "UPDATE tb_perusahaan 
								SET 
									nama_perusahaan = '$v_nama_perusahaan',
									alamat 			= '$v_alamat',
									no_telp 		= '$v_no_telp',
									logo 			= '$v_logo',
									ket_perusahaan 	= '$v_ket_perusahaan' 
								WHERE user_id 		= '".$v_user_id."' ";

						if ($conn->query($sql) === TRUE) {

							echo '<script>alert("data berhasil diubah"); </script>';
			 				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.profil">';	    	
						}else{
							echo "terjadi kesalahan fatal" .$sql.' <br> ' .$conn->error;
						}
					} else {
						echo '<script>alert("gagal upload file"); </script>';
						echo '<meta http-equiv="refresh" content="0;URL=?p=employer.profil">';
					// }
				}
			} else {
				echo '<script>alert("ukuran file maks 1 mb"); </script>';
				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.profil">';
			}
		} else {
			echo '<script>alert("ekstensi file tidak diijinkan"); </script>';
			echo '<meta http-equiv="refresh" content="0;URL=?p=employer.profil">';
			}
		}
		$conn->close();
	}

	if ( isset($_POST['update']) ) 
	{
		$getId		= $_GET['user_id'];
		$v_user_id	= $_POST['user_id'];
		$cek   		= "SELECT * FROM tb_perusahaan WHERE user_id = '".$getId."' "; 
		$res    	= $conn->query($cek);
		$data   	= $res->fetch_array();

		$allowExt 			= array( 'png', 'jpg', 'jpeg' );

		$fileName 			= $_FILES['logo']['name'];
		$fileExt			= strtolower(end(explode('.', $fileName)));
		$fileSize			= $_FILES['logo']['size'];
		$fileTemp 			= $_FILES['logo']['tmp_name'];

		$v_nama_perusahaan 	= $_POST['nama_perusahaan'];
		$v_alamat			= $_POST['alamat'];
		$v_kota				= $_POST['kota'];
		$v_prov				= $_POST['prov'];
		$v_no_telp			= $_POST['no_telp'];

		$v_ket_perusahaan	= $_POST['ket_perusahaan'];

		$upload_dir 		= "dist/images/logo/";
		$logo 				= basename ($fileName);
		$v_logo 			= str_replace(' ','_',$logo);

		// jika logo tidak diubah 
		if ( empty($fileTemp) ) 
		{
			$sql = "UPDATE tb_perusahaan 
							SET 
								nama_perusahaan = '$v_nama_perusahaan',
								alamat 			= '$v_alamat',
								no_telp 		= '$v_no_telp',
								ket_perusahaan 	= '$v_ket_perusahaan' 
							WHERE user_id 		= '".$v_user_id."' ";

			if ($conn->query($sql) === TRUE) {

				echo '<script>alert("data berhasil diubah"); </script>';
 				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';	    	
			}else{
				echo "terjadi kesalahan fatal" .$sql.' <br> ' .$conn->error;
			}
		}

		// jika logo diubah
		else if( !empty($fileTemp) ) 
		{

		if ( in_array( $fileExt, $allowExt ) === TRUE ) 
		{
			if ( $fileSize < 1044070 ) 
			{
				// $sqlCek = "SELECT * 
				// 			FROM tb_perusahaan 
				// 		WHERE nama_perusahaan = '$v_nama_perusahaan' ";

		  //   	$result = $conn->query($sqlCek);
			    
			 //    if ($result->num_rows > 0) 
			 //    {
			 //        echo '<script>alert("nama perusahaan sudah terdaftar"); </script>';
 			// 		echo '<meta http-equiv="refresh" content="0;URL=?p=perusahaan.profil">';
			 //    } else {

					if ( move_uploaded_file( $fileTemp,$upload_dir.$v_logo) ) 
					{
						unlink($upload_dir.$data['logo']);

						$sql = "UPDATE tb_perusahaan 
								SET 
									nama_perusahaan = '$v_nama_perusahaan',
									alamat 			= '$v_alamat',
									no_telp 		= '$v_no_telp',
									logo 			= '$v_logo',
									ket_perusahaan 	= '$v_ket_perusahaan' 
								WHERE user_id 		= '".$v_user_id."' ";

						if ($conn->query($sql) === TRUE) {

							echo '<script>alert("data berhasil diubah"); </script>';
			 				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';	    	
						}else{
							echo "terjadi kesalahan fatal" .$sql.' <br> ' .$conn->error;
						}
					} else {
						echo '<script>alert("gagal upload file"); </script>';
						echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';
					// }
				}
			} else {
				echo '<script>alert("ukuran file maks 1 mb"); </script>';
				echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';
			}
		} else {
			echo '<script>alert("ekstensi file tidak diijinkan"); </script>';
			echo '<meta http-equiv="refresh" content="0;URL=?p=employer.view">';
			}
		}
		$conn->close();
	}
