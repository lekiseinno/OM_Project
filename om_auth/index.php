<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
	<title>OM :: Authentication</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../_favicon/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
	<link rel="stylesheet" href="asset/css/bootstrap.css">
	<link rel="stylesheet" href="asset/css/pace.css">
	<link rel="stylesheet" href="asset/css/authentication.css">
	<script src="asset/js/pace.min.js"></script>
	<script src="asset/js/jquery-3.4.1.min.js"></script>
	<style type="text/css">
		.pace-running
		{
			opacity:0.5;
			cursor: wait;
		}
		.btn-75
		{
			width: 75%;
		}
	</style>
</head>
<body>
	<div class="page-loader">
		<div class="bg-primary"></div>
	</div>
	<div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('asset/img/<?php echo rand(1,10); ?>.jpg'); background-size: 100% auto;">
		<div class="ui-bg-overlay bg-dark opacity-25"></div>
		<div class="authentication-inner py-5">
			<div class="card">
				<div class="p-4 p-sm-4">
					<div class="d-flex justify-content-center align-items-center pb-2 mb-3">
						<div class="ui-w-60">
							<div class="w-100 position-relative" >
								<img src="asset/img/logo.png">
							</div>
						</div>
					</div>
					<h5 class="text-center text-muted font-weight-normal mb-3">Login to Your Account</h5>
					<form action="action/login.php" method="POST">
						<div class="form-group">
							<label class="form-label">Username</label>
							<input name="username" type="text" class="form-control">
						</div>
						<div class="form-group">
							<!--
							<label class="form-label d-flex justify-content-between align-items-end">
								<div>Password</div>
							</label>
							-->
							<label class="form-label">Password</label>
							<input  name="password" type="password" class="form-control">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-75">Sign In</button>
						</div>
					</form>
				</div>
				<div class="card-footer py-3 px-4 px-sm-5">
					<div class="text-center text-muted">
						<span style="font-size: 11px;">
							&copy; 2019 - LeKise co.,ltd. All Right Reserve
							<br>
							Made with <span style="color: #f15465; font-family: 'Source Sans Pro', sans-serif;">❤</span> by IT LeKise - Innovation team
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="asset/js/popper.js"></script>
	<script src="asset/js/bootstrap.js"></script>
</body>
</html>