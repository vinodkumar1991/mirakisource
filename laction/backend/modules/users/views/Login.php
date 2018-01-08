<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description"
	content="Responsive admin dashboard and web application ui kit. ">
<meta name="keywords" content="login, signin">

<title>Login Page 3 &mdash; TheAdmin</title>

<!-- Fonts -->
<link
	href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i"
	rel="stylesheet">

<!-- Styles -->
<link href="<?php echo Yii::getAlias('@asset').'/css/core.min.css';?>"
	rel="stylesheet">
<link href="<?php echo Yii::getAlias('@asset').'/css/app.min.css'; ?>"
	rel="stylesheet">
<link href="<?php echo Yii::getAlias('@asset').'/css/style.min.css'; ?>"
	rel="stylesheet">

<!-- Favicons -->
<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
<link rel="icon" href="assets/img/favicon.png">
</head>

<body>


	<div class="row no-gutters min-h-fullscreen bg-white">
		<div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img"
			style="background-image: url(<?php echo Yii::getAlias('@asset').'/img/gallery/11.jpg';?>)" data-overlay="5">

			<div class="row h-100 pl-50">
				<div class="col-md-10 col-lg-8 align-self-end">
					<img
						src="<?php echo Yii::getAlias('@asset').'/img/logo-light-lg.png'; ?>"
						alt="..."> <br> <br> <br>
					<h4 class="text-white">The admin is the best admin framework
						available online.</h4>
					<p class="text-white">Credibly transition sticky users after
						backward-compatible web services. Compellingly strategize team
						building interfaces.</p>
					<br> <br>
				</div>
			</div>

		</div>



		<div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
			<div class="px-80 py-30">
				<h4>Login</h4>
				<p>
					<small>Sign into your account</small>
				</p>
				<br>

				<form class="form-type-material">
					<div class="form-group">
						<input type="text" class="form-control" id="username"> <label
							for="username">Username</label>
					</div>

					<div class="form-group">
						<input type="password" class="form-control" id="password"> <label
							for="password">Password</label>
					</div>

					<div class="form-group flexbox">
						<label class="custom-control custom-checkbox"> </label> <a
							class="text-muted hover-primary fs-13" href="#">Forgot password?</a>
					</div>

					<div class="form-group">
						<button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
					</div>
				</form>


			</div>
		</div>
	</div>




	<!-- Scripts -->
	<script src="<?php echo Yii::getAlias('@asset').'/js/core.min.js';?>"></script>
	<script src="<?php echo Yii::getAlias('@asset').'/js/app.min.js';?>"></script>
	<script src="<?php echo Yii::getAlias('@asset').'/js/script.min.js';?>"></script>

</body>
</html>

