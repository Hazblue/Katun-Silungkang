<header>
	<div class="container">
		<div class="row">
			<div class="first-div">
			<div class="col-md-12">
				<div class="col-md-6">
					<a href="index.php"><img src ="img/c.png" width ="150px" height ="150px" class="img-responsive"></a>
				</div>
				<div class="container">
				<div class="col-md-6">
						<div class="top">
							<div class="top-menu">
									<?php
										if(isset($_SESSION['pelanggan']))
										{
										include 'koneksi.php';
											{
												echo '<ul>
												<li><a href="profil.php"><i class="fa fa-user-circle">USER</a></i></li>';
												echo '<li> | </li>';
												echo '<li><a href="logout.php"><i class="fa fa-sign-out"> KELUAR </i></span></a></li>
												</ul>';
											}
									}
									else {
											echo '<ul>
											<li><a href="login.php"> <i class="fa fa-user"> MASUK </i> </a></li>';
											echo '<li> | </li>';
											echo '<li><a href="daftar.php"> <i class=" fa fa-user-plus"> DAFTAR </i></span></a></li>
											</ul>';
										}
									?>
									<br>
									<br>
								<script src="js/search.js"></script>
								<form action="pencarian.php" class="navbar-form" role="search">
									<div class="form-group">
										<input type="text" class="form-control" name="keyword" onkeyup="showResult(this.value)">
										<button type="submit" class="btn search-btn"><i class="fa fa-search"></i></button>
										<div id="livesearch"></div>
									</div>
								</form>
							</div>
						</div>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</header>
