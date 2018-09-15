<!DOCTYPE html>
<html>
<head>
	<title>Seller & Admin Log In &bull; HeirloomNation</title>
	<?php include "includes/libraries-out.php";?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-sm-4"></div>
			<div class="col-lg-4 col-sm-4">
			<center><img src="web-images/hn-logo.png" class="img-responsive margin-bottom-lg" style="height: 125px; width: auto; margin-top: 25px;"></center>
			  <div class="panel panel-default">
			  	<div class="panel-body">
			  		<h2>Log In</h2>
			  		<span id="login-response">
			  		<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
			  		  <div class="form-group">
			            <label>Account Type:</label>
			            <select class="form-control " name="acc_type" required="true">
			            	<option value="Admin">Admin</option>
			            	<option value="Seller">Seller</option>
			            	<option selected="selected">Select account type...</option>
			            </select>
			          </div>
					  <div class="form-group">
			            <label>Email:</label>
			            <input type="email" class="form-control " name="email" required="true">
			          </div>
			          <div class="form-group">
			            <label>Password:</label>
			            <input type="password" class="form-control " name="password" required="true">
			          </div>
			          <span id="btn-response">
			          <button type="submit" class="btn btn-success btn-block  margin-bottom-lg" onclick="form_process ('login-form', 'functions/verify-login-2.php', 'login-response')">Log In</button>
			          </span>
					</form>
					</span>
			  	</div>
			  </div>
			  <p class="text-center margin-bottom-lg">&copy; HeirloomNation. All Rights Reserved 2018</p>	
			</div>
			<div class="col-lg-4 col-sm-4"></div>
		</div>
	</div>
</body>
</html>