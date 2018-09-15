<?php
	include "config.php";

	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['birthdate']) && isset($_POST['gender']) && isset($_POST['address'])) {
		$chk_email_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where email = '".$_POST['email']."'");
		$chk_email_row = $chk_email_query->fetch();

		$chk_name_query = $conn->query("select count(acc_id) as acc_id from costumers_tbl where firstname = '".$_POST['firstname']."' and lastname = '".$_POST['lastname']."'");
		$chk_name_row = $chk_name_query->fetch();

		if ($chk_email_row['acc_id'] == 0) {
			if ($chk_name_row['acc_id'] == 0) {
				$save_query = $conn->prepare("insert into accounts_tbl (email, password, acc_type, acc_status)values(:email, :password, :acc_type, :acc_status)");
				$save_query->bindParam(":email", $_POST['email']);
				$save_query->bindParam(":password", $password);
				$save_query->bindParam(":acc_type", $acc_type);
				$save_query->bindParam(":acc_status", $acc_status);
				$password = md5($_POST['password']);
				$acc_type = "Costumer";
				$acc_status = "Verified";

				if ($save_query->execute()) {
					$acc_id = $conn->lastInsertId();
					$acc_query = $conn->query("select * from accounts_tbl where acc_id = '$acc_id' and acc_type = 'Costumer'");
					$acc_row = $acc_query->fetch();

					$save_query2 = $conn->prepare("insert into costumers_tbl (acc_id, firstname, lastname, birthdate, age, gender, address, profile_photo)values(:acc_id, :firstname, :lastname, :birthdate, :age, :gender, :address, :profile_photo)");
					$save_query2->bindParam(":acc_id", $acc_row['acc_id']);
					$save_query2->bindParam(":firstname", $_POST['firstname']);
					$save_query2->bindParam(":lastname", $_POST['lastname']);
					$save_query2->bindParam(":birthdate", $_POST['birthdate']);
					$save_query2->bindParam(":age", $age);
					$save_query2->bindParam(":gender", $_POST['gender']);
					$save_query2->bindParam(":address", $_POST['address']);
					$save_query2->bindParam(":profile_photo", $profile_photo);
					$today = date("Y/m/d", strtotime("today"));
					$age = $today - $_POST['birthdate'];
					$profile_photo = "../profile-photos/default.png";

					if ($save_query2->execute()) {
					?>
							<div class="alert alert-success">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong><i class="fa fa-check fa-fw"></i></strong>Sign up successful. You can now login using your e-mail and password.
							</div>
							<form class="row" onsubmit="loading ('btn-response')" autocomplete="off" id="signup-form" method="POST">
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Email:</label>
					              <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Password:</label>
					              <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Firstname:</label>
					              <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Lastname:</label>
					              <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Birthdate:</label>
					              <input type="date" class="form-control input-lg" value="<?=$_POST['birthdate'];?>" name="birthdate" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Gender:</label>
					              <select class="form-control input-lg" name="gender" required="true">
					                <option <?php if ($_POST['gender'] == "Male") {echo "selected='selected'";}?> value="Male">Male</option>
					                <option <?php if ($_POST['gender'] == "Female") {echo "selected='selected'";}?> value="Female">Female</option>
					                <option>Select Gender...</option>
					              </select>  
					            </div>
					          </div>
					          <div class="col-lg-12 col-sm-12">
					            <div class="form-group">
					              <label>Address:</label>
					              <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea> 
					            </div>
					          </div>
					          <div class="col-lg-12 col-sm-12">
					          	<span class="btn-response">
					              <button type="submit" class="btn btn-success btn-lg" onclick="form_process ('signup-form', 'functions/verify-signup.php', 'signup-response')">Create Account</button>
					            </span>  
					          </div> 
					        </form>
					<?php
					}
				}
			}
			else {
			?>

							<div class="alert alert-danger">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong><i class="fa fa-exclamation-circle fa-fw"></i></strong>Sign up failed. Name already existed in the system.
							</div>
							<form class="row" onsubmit="loading ('btn-response')" autocomplete="off" id="signup-form" method="POST">
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Email:</label>
					              <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Password:</label>
					              <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Firstname:</label>
					              <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Lastname:</label>
					              <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Birthdate:</label>
					              <input type="date" class="form-control input-lg" value="<?=$_POST['birthdate'];?>" name="birthdate" required="true">
					            </div>
					          </div>
					          <div class="col-lg-6 col-sm-6">
					            <div class="form-group">
					              <label>Gender:</label>
					              <select class="form-control input-lg" name="gender" required="true">
					                <option <?php if ($_POST['gender'] == "Male") {echo "selected='selected'";}?> value="Male">Male</option>
					                <option <?php if ($_POST['gender'] == "Female") {echo "selected='selected'";}?> value="Female">Female</option>
					                <option>Select Gender...</option>
					              </select>  
					            </div>
					          </div>
					          <div class="col-lg-12 col-sm-12">
					            <div class="form-group">
					              <label>Address:</label>
					              <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea> 
					            </div>
					          </div>
					          <div class="col-lg-12 col-sm-12">
					          	<span class="btn-response">
					              <button type="submit" class="btn btn-success btn-lg" onclick="form_process ('signup-form', 'functions/verify-signup.php', 'signup-response')">Create Account</button>
					            </span>  
					          </div> 
					        </form>
			<?php
			}
		}
		else {
		?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Sign up failed. E-mail already existed in the system.
						</div>
						<form class="row" onsubmit="loading ('btn-response')" autocomplete="off" id="signup-form" method="POST">
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Email:</label>
				              <input type="email" class="form-control input-lg" name="email" required="true">
				            </div>
				          </div>
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Password:</label>
				              <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
				            </div>
				          </div>
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Firstname:</label>
				              <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
				            </div>
				          </div>
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Lastname:</label>
				              <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
				            </div>
				          </div>
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Birthdate:</label>
				              <input type="date" class="form-control input-lg" value="<?=$_POST['birthdate'];?>" name="birthdate" required="true">
				            </div>
				          </div>
				          <div class="col-lg-6 col-sm-6">
				            <div class="form-group">
				              <label>Gender:</label>
				              <select class="form-control input-lg" name="gender" required="true">
				                <option <?php if ($_POST['gender'] == "Male") {echo "selected='selected'";}?> value="Male">Male</option>
				                <option <?php if ($_POST['gender'] == "Female") {echo "selected='selected'";}?> value="Female">Female</option>
				                <option>Select Gender...</option>
				              </select>  
				            </div>
				          </div>
				          <div class="col-lg-12 col-sm-12">
				            <div class="form-group">
				              <label>Address:</label>
				              <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea> 
				            </div>
				          </div>
				          <div class="col-lg-12 col-sm-12">
				          	<span class="btn-response">
				              <button type="submit" class="btn btn-success btn-lg" onclick="form_process ('signup-form', 'functions/verify-signup.php', 'signup-response')">Create Account</button>
				            </span>  
				          </div> 
				        </form>
		<?php
		}
	}
?>