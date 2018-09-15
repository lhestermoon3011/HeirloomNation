<!DOCTYPE html>
<html>
<head>
	<title>Home &bull; HeirloomNation</title>
	<?php include "includes/libraries-out.php";?>
</head>
<body>
<?php include "navbar.php";?>
	<div class="container-fluid" style="margin-top: 100px;">
		<div class="row">
			<div class="col-lg-4 col-sm-4"></div>
			<div class="col-lg-4 col-sm-4">
			  <div class="panel panel-default">
			  	<div class="panel-body">
			  		<h2>Log In</h2>
			  		<span id="login-response">
			  		<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
					  <div class="form-group">
			            <label>Email:</label>
			            <input type="email" class="form-control" name="email" required="true">
			          </div>
			          <div class="form-group">
			            <label>Password:</label>
			            <input type="password" class="form-control" name="password" required="true">
			          </div>
			          <span id="btn-response">
			          <button type="submit" class="btn btn-success btn-block" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In</button>
								</span>
								<button type="submit" class="btn btn-danger btn-block margin-top-sm" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In With <i class="fab fa-google fa-fw"></i></button>
					</form>
					</span>
					<hr>
					<p class="lead text-center">Don't have an account yet? <a href="signup.php" class="btn btn-warning btn-lg">Sign Up <i class="fa fa-chevron-right fa-fw"></i></a></p>
			  	</div>
			  </div>
			  <p class="text-center margin-bottom-lg">&copy; HeirloomNation. All Rights Reserved 2018</p>	
			</div>
			<div class="col-lg-4 col-sm-4"></div>
		</div>
	</div>
</body>
</html>		