<?php
	require_once(dirname(__FILE__).'/koneksi.php');
 	require_once 'GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
	include 'test.php';

	$googleAuthenticator = new PHPGangsta_GoogleAuthenticator();
//	$QR_Code = $_POST["data"];
	$arraypelanggan = $_GET["array_data"];
	
	$mfaSecret = $googleAuthenticator->createSecret();
	$qrCode = $googleAuthenticator->getQRCodeGoogleUrl($arraypelanggan["nama_pelanggan"], $mfaSecret);

//	$id_pelanggan = $_GET["data"];

//	$datapelanggan=  $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan' ");
//	$nama_pelanggan = $datapelanggan["nama_pelanggan"];
	$cekMFA =  $googleAuthenticator->verifyCode($qrCode, $_POST["kode_verifikasi"], 3);

	if(isset($POST['kode_verifikasi'])){
		if($cekMFA){
				$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan, role) VALUES ('$email', '$password', '$nama', '$telepon', '$alamat', '$role')");

				echo "<script>location='login.php';</script>";
		}else{
				echo "<script>alert('Kode verifikasi anda tidak sesuai');</script>";

		}
	}

	?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daftar | Katun Silungkang</title>

		<link rel="icon" type="image/png" href="img/.png">
		<link rel="stylesheet" href="css/febi.css">

		<!-- Bootstrap-->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/jquery.bxslider.css">
	</head>
	<body>
		<!-- Header-->
		<br><br><br><br>
		<center>
			<div class="container">
		<div class="row">
	   
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
			<div class="form">
				<div class="panel-heading">
				</div>
				<div class="panel-body">
					<form method="post">
						<a href = "index.php"><img src ="img/c.png" width ="150px" height ="150px"></a>  
 						<div class="row">
 							<?php
                               if ($qrCode != "") {
                                   echo "<img src='$qrCode' alt='QR Code'><br><br>";

                               }
                            ?>
 						</div>
 						<div class="row">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="fa fa-user fa-fw"></span>
								 </span>
								<input type="text"  name="kode_verifikasi" class="form-control" placeholder="Kode Verifikasi" required></input>
							</div>
						</div>
						<div class="row"> 
							<center>
								<button class="btn btn-primary" name="submit_kode">Submit</button>
							</center>
						</div>
						<div class="row">
							<a href ="login.php"><b>Sudah memiliki akun ? </b>Masuk</a>
						</div>
						</br>
					</form>	
				</div>
			</div>
	
	</div>
</div>
</center>
<br><br>
<br><br>

		<?php
			require_once(dirname(__FILE__).'/commons/footer.php');
		?>
			<!-- Scroll Up Button -->
		<a href="#" class="scrollup"><i class="fa fa-angle-up fa-2x active"></i></a>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-3.1.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.singlePageNav.js"></script>
		<script src="js/jquery.flexslider.js"></script>
		<script src="js/jquery.appear.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/wow.min.js"></script>
		<script>wow = new WOW({}).init();</script>
		<script>
			$('.carousel').carousel({			//Waktu Carousel
				interval: 3000
			})
		</script>
	
</body>
</html>