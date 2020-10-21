<?php
	session_start(); 
	include 'koneksi.php';
	require_once 'googleauthenticator/PHPGangsta/GoogleAuthenticator.php';
	$googleAuthenticator = new PHPGangsta_GoogleAuthenticator();

 

 	function HassPassword($passwordciper) {
		 $salt = "*&^%$$#@!!~><?";
		 $saltedpassword = $passwordciper.$salt;
		 $password=hash('sha256',$saltedpassword);
		 return $password;

	}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Login Pelanggan</title>

		<link rel="icon" type="image/png" href="img/.png">
		<link rel="stylesheet" href="css/febi.css">

		<!-- Bootstrap-->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/jquery.bxslider.css">
	</head>
<body>

<br><br><br><br><br>
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
							<div class="input-group">
							 	<span class="input-group-addon">
						  			<span class="fa fa-envelope fa-fw"></span>
							 	</span>
								<input type="email"  name="email" class="form-control" placeholder="Email" required></input>
					  		</div>
						</div>		
						<div class="row">
							<div class="input-group">
					 			<span class="input-group-addon">
								  <span class="fa fa-key fa-fw"></span>
								</span>
								<input type="password" name="password" class="form-control" placeholder="Password" required></input>
					  		</div>
						</div>
					    <div class="row">
					    	<div class="input-group">
					 			<span class="input-group-addon">
						  			<span class="fa fa-key fa-fw"></span>
								</span>
								<input type="number" name="mfa_user" class="form-control" placeholder="Kode Verifikasi" required></input>
					  		</div>
					    </div>
						<div class="row"> 
							<button class="btn btn-primary" name="login">Masuk</button>
						</div>
						<div class="row">
							<a href ="daftar.php">Belum Memiliki Akun? <b>Daftar disini</b></a>
						</div>
					</form>	
				</div>
			</div>
	
	</div>
</div>
</center>

<?php 

	if (isset($_POST["login"])){

			$email = $_POST["email"];
			$password = HassPassword($_POST["password"]); 
			$mfa_user = $_POST["mfa_user"];
			$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password' "); 
			$akunyangcocok = $ambil->num_rows; 

			if ($akunyangcocok==1)
			{ 
				$akun = $ambil->fetch_assoc(); 
				$cekMFA =  $googleAuthenticator->verifyCode($akun["mfa_secret"], $mfa_user, 3);

				if($cekMFA){
				
					if($akun["role"] == "pelanggan"){

						$id = $akun["id_pelanggan"];
						$_SESSION["pelanggan"] = $akun; 
						//echo "<script>location='index.php?$id';</script>";	 
					echo "<script>location='index.php?$id';</script>";	 
					if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])){
					echo "<script>location='checkout.php';</script>";		
					}else{
						echo "<script>location='riwayat.php';</script>";	
					}
			
					}else if($akun["role"]== "admin"){
						 
						 $_SESSION['admin']=$akun;
	              		//  echo "<div class='alert alert-info'>Login Sukses</div>";
	                	echo "<meta http-equiv='refresh' content='1;url=admin/index.php'; >";
					
					}
				}else{
					echo "<script>alert('Gagal Login');</script>";
				} 
			}else{	
				echo "<script>alert('Gagal Login');</script>"; 
			}
		}	
?>
<br><br><br><br><br><br><br>
		<?php
			require_once(dirname(__FILE__).'/commons/footer.php');
		?>

</body>
</html>