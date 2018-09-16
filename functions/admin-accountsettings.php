<?php
	include "config.php";
	include "admin-account-session.php";

	if (isset($_POST)) {
		if ($acc_row['password'] == $_POST['old_password']) {
			$save_query = $conn->prepare("update accounts_tbl set email = :email, password = :password where acc_id = '".$acc_row['acc_id']."'");
			$save_query->bindParam(":email", $_POST['email']);
			$save_query->bindParam(":password", $_POST['new_password']);

			if ($save_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Account has been updated.
			</div>
			<form id="adsettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">E-mail:</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Old Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="old_password" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">New Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="new_pass" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <span id="btn-response"> 
	                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('adsettings-form', '../functions/admin-accountsettings.php', 'adsettings-response')">Update</button>
	                </span>
	              </div>
	            </div>
	          </form>
			<?php
			}
			else {
			?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Updating of account failed. Please try again.
			</div>
			<form id="adsettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">E-mail:</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Old Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="old_password" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">New Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="new_pass" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <span id="btn-response"> 
	                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('adsettings-form', '../functions/admin-accountsettings.php', 'adsettings-response')">Update</button>
	                </span>
	              </div>
	            </div>
	          </form>
			<?php	
			}
		}
		else {
		?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Old password entry incorrenct. Please try again.
			</div>
			<form id="adsettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">E-mail:</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Old Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="old_password" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">New Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="new_pass" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <span id="btn-response"> 
	                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('adsettings-form', '../functions/admin-accountsettings.php', 'adsettings-response')">Update</button>
	                </span>
	              </div>
	            </div>
	          </form>
		<?php	
		}
	}
?>