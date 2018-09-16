<?php
	include "config.php";

	if (isset($_POST)) {
		include "account-session.php";
		$cur_pass = md5($_POST['cur_password']);
		$check_query = $conn->query("select * from accounts_tbl where acc_id = '".$acc_row['acc_id']."'");
		$check_row = $check_query->fetch();

		if ($check_row['password'] == $cur_pass) {
			$update_query = $conn->prepare("update accounts_tbl set email = :email, password = :password where acc_id = :acc_id");
			$update_query->bindParam(":email", $_POST['email']);
			$update_query->bindParam(":password", $new_pass);
			$update_query->bindParam(":acc_id", $acc_row['acc_id']);
			$new_pass = md5($_POST['new_password']);

			if ($update_query->execute()) {
			?>
			<script type="text/javascript">
				window.location.assign("<?=$_POST['url'];?>");
			</script>
			<?php
			}
		}
		else {
		?>
			<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Current password incorrect. Please try again.
			</div>
			<form id="accountsettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <input type="hidden" name="url" value="<?=$_POST['url'];?>">
	            <div class="form-group">
	              <label class="control-label col-sm-2">E-mail:</label>
	              <div class="col-sm-10">
	                <input type="email" class="form-control input-lg" name="email" value="<?=$_POST['email'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Current Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="cur_password" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">New Password:</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control input-lg" name="new_password" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <span id="btn-response"> 
	                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('accountsettings-form', '../functions/update-account.php', 'accountsettings-response')">Update</button>
	                </span>
	              </div>
	            </div>
	        </form>
		<?php	
		}
	}
?>