<!DOCTYPE html>
<html>
<head>
	<title>Create Account &bull; HeirloomNation</title>
	<?php include "includes/libraries-out.php";?>
</head>
<body>
<?php include "navbar.php";?>
	<div class="container-fluid" style="margin-top: 100px;">	
		<div class="row">
			<div class="col-lg-2 col-sm-2"></div>
			<div class="col-lg-8 col-sm-8">
			  <div class="panel panel-default">
			  	<div class="panel-body">
			  		<h2>Create Account</h2>
			  		<span id="signup-response">
			  		<form class="row" onsubmit="loading ('btn-response')" autocomplete="off" id="signup-form" method="POST">
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Email:</label>
			              <input type="email" class="form-control" name="email" required="true">
			            </div>
			          </div>
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Password:</label>
			              <input type="password" class="form-control" name="password" required="true">
			            </div>
			          </div>
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Firstname:</label>
			              <input type="text" class="form-control" name="firstname" required="true">
			            </div>
			          </div>
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Lastname:</label>
			              <input type="text" class="form-control" name="lastname" required="true">
			            </div>
			          </div>
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Birthdate:</label>
			              <input type="date" class="form-control" name="birthdate" required="true">
			            </div>
			          </div>
			          <div class="col-lg-6 col-sm-6">
			            <div class="form-group">
			              <label>Gender:</label>
			              <select class="form-control" name="gender" required="true">
			                <option value="Male">Male</option>
			                <option value="Female">Female</option>
			                <option selected="selected">Select Gender...</option>
			              </select>  
			            </div>
			          </div>
			          <div class="col-lg-12 col-sm-12">
			            <div class="form-group">
			              <label>Address:</label>
			              <textarea class="form-control" name="address" required="true"></textarea> 
			            </div>
			          </div>
			          <div class="col-lg-12 col-sm-12">
			          	<span id="btn-response">
			            <button type="submit" class="btn btn-success" onclick="form_process ('signup-form', 'functions/verify-signup.php', 'signup-response')">Create Account</button>
			            </span>  
			          </div> 
			        </form>
			        </span>
					<hr>
					<p class="lead text-center">Already have an account? <a href="login.php" class="btn btn-warning">Log In <i class="fa fa-sign-in-alt fa-fw"></i></a></p>
			  	</div>
			  </div>
			  <p class="text-center margin-bottom-lg">&copy; HeirloomNation. All Rights Reserved 2018</p>	
			</div>
			<div class="col-lg-2 col-sm-2"></div>
		</div>
	</div>
</body>
</html>		