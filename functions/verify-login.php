<?php
	include "config.php";

	if (isset($_POST['email']) && isset($_POST['password'])) {
		$chk_account_query = $conn->query("select * from accounts_tbl where email = '".$_POST['email']."' and acc_type = 'Costumer'");
		$chk_account_row = $chk_account_query->fetch();

		if ($chk_account_row['acc_status'] == "Activated") {			
			if ($chk_account_row['email'] == $_POST['email'] && $chk_account_row['password'] == md5($_POST['password'])) {
				$save_query = $conn->prepare("insert into account_logs (acc_id, log_type)values(:acc_id, :log_type)");
				$save_query->bindParam(":acc_id", $chk_account_row['acc_id']);
				$save_query->bindParam(":log_type", $log_type);
				$log_type = "Log In";

				$save_query->execute();
				session_start();
				$_SESSION['acc_id'] = $chk_account_row['acc_id'];
				$_SESSION['email'] = $chk_account_row['email'];
				$_SESSION['acc_type'] = $chk_account_row['acc_type'];
				?>
				<script type="text/javascript">
					window.location.assign("costumers/index.php");
				</script>
				<?php
			}
			else if ($chk_account_row['email'] == $_POST['email'] && $chk_account_row['password'] != md5($_POST['password'])) {
			?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Password entry incorrect. Please try again.
						</div>
						<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
						  <div class="form-group">
				            <label>Email:</label>
				            <input type="email" class="form-control " name="email" value="<?=$_POST['email'];?>" required="true">
				          </div>
				          <div class="form-group">
				            <label>Password:</label>
				            <input type="password" class="form-control " name="password" required="true">
				          </div>
				          <span id="btn-response">
				          <button type="submit" class="btn btn-success" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In</button>
				          </span>
						</form>
			<?php	
			}
			else {
			?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Account entry failed. Please try again.
						</div>
						<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
						  <div class="form-group">
				            <label>Email:</label>
				            <input type="email" class="form-control " name="email" required="true">
				          </div>
				          <div class="form-group">
				            <label>Password:</label>
				            <input type="password" class="form-control " name="password" required="true">
				          </div>
				          <span id="btn-response">
				          <button type="submit" class="btn btn-success" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In</button>
				          </span>
						</form>	
			<?php	
			}
		}
		else if ($chk_account_row['acc_status'] == "Deactivated") {
		?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Account has been deactivated. You cannot access the system for a while. 
						</div>
						<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
						  <div class="form-group">
				            <label>Email:</label>
				            <input type="email" class="form-control " name="email" required="true">
				          </div>
				          <div class="form-group">
				            <label>Password:</label>
				            <input type="password" class="form-control " name="password" required="true">
				          </div>
				          <span id="btn-response">
				          <button type="submit" class="btn btn-success" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In</button>
				          </span>
						</form>	
		<?php
		}
		else if ($chk_account_row['acc_status'] == "Unverified") {
		?>
					<span id="verif-response">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Account not verified yet. Please re-check your email and copy the verification code.
						</div>
						<form autocomplete="off" id="verif-form" method="POST">
							<input type="hidden" value="<?=$chk_account_row['acc_id'];?>" name="acc_id" required="true">
							</div>
							<div class="form-group">
					              <label>Verification Code:</label>
					              <input type="password" class="form-control " value="" name="verif_code" required="true">
					        </div>
					        <button type="submit" class="btn btn-success" onclick="form_process ('verif-form', 'functions/verify-email.php', 'verif-response')">Verify</button>
						</form>
					</span>	
		<?php
		}
		else {
		?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Account entry failed. Please try again.
						</div>
						<form onsubmit="loading ('btn-response')" autocomplete="off" id="login-form" method="POST">
						  <div class="form-group">
				            <label>Email:</label>
				            <input type="email" class="form-control " name="email" required="true">
				          </div>
				          <div class="form-group">
				            <label>Password:</label>
				            <input type="password" class="form-control " name="password" required="true">
				          </div>
				          <span id="btn-response">
				          <button type="submit" class="btn btn-success" onclick="form_process ('login-form', 'functions/verify-login.php', 'login-response')">Log In</button>
				          </span>
						</form>
		<?php
		}
	}
?>