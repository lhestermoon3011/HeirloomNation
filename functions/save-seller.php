<?php
	include "config.php";

	if (isset($_POST)) {
		$chk_account_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where email = '".$_POST['email']."' and acc_type = 'Seller'");
		$chk_account_row = $chk_account_query->fetch();

		if ($chk_account_row['acc_id'] == 0) {
			$save_query = $conn->prepare("insert into accounts_tbl (email, password, acc_type, acc_status)values(:email, :password, :acc_type, :acc_status)");
			$save_query->bindParam(":email", $_POST['email']);
			$save_query->bindParam(":password", $password);
			$save_query->bindParam(":acc_type", $acc_type);
			$save_query->bindParam(":acc_status", $acc_status);
			$password = md5($_POST['password']);
			$acc_type = "Seller";
			$acc_status = "Activated";

			if ($save_query->execute()) {
				$acc_id = $conn->lastInsertId();
				$acc_query = $conn->query("select * from accounts_tbl where acc_id = '".$acc_id."'");
				$acc_row = $acc_query->fetch();

				$save_query2 = $conn->prepare("insert into sellers_tbl (acc_id, firstname, lastname, mobile_number, address)values(:acc_id, :firstname, :lastname, :mobile_number, :address)");
				$save_query2->bindParam(":acc_id", $acc_row['acc_id']);
				$save_query2->bindParam(":firstname", $_POST['firstname']);
				$save_query2->bindParam(":lastname", $_POST['lastname']);
				$save_query2->bindParam(":mobile_number", $_POST['mobile']);
				$save_query2->bindParam(":address", $_POST['address']);

				if ($save_query2->execute()) {
				?>
				<script type="text/javascript">
					window.location.assign("../admin/admin-selleraccounts.php");
				</script>
				<?php
				}
				else {
				?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Adding of account failed. Please try again.
				</div>
				<form id="addseller-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
		            <div class="form-group">
		              <label class="control-label col-sm-2">E-mail:</label>
		              <div class="col-sm-10">
		                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Password:</label>
		              <div class="col-sm-10">
		                <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Firstname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Lastname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Mobile Number:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['mobile'];?>" name="mobile" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Address:</label>
		              <div class="col-sm-10">
		                <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea>
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('addseller-form', '../functions/save-seller.php', 'addseller-response')">Save</button>
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
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Adding of account failed. Please try again.
				</div>
				<form id="addseller-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
		            <div class="form-group">
		              <label class="control-label col-sm-2">E-mail:</label>
		              <div class="col-sm-10">
		                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Password:</label>
		              <div class="col-sm-10">
		                <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Firstname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Lastname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Mobile Number:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['mobile'];?>" name="mobile" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Address:</label>
		              <div class="col-sm-10">
		                <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea>
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('addseller-form', '../functions/save-seller.php', 'addseller-response')">Save</button>
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
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> E-mail has already used. Please try again.
				</div>
				<form id="addseller-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
		            <div class="form-group">
		              <label class="control-label col-sm-2">E-mail:</label>
		              <div class="col-sm-10">
		                <input type="email" class="form-control input-lg" value="<?=$_POST['email'];?>" name="email" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Password:</label>
		              <div class="col-sm-10">
		                <input type="password" class="form-control input-lg" value="<?=$_POST['password'];?>" name="password" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Firstname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['firstname'];?>" name="firstname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Lastname:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['lastname'];?>" name="lastname" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Mobile Number:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['mobile'];?>" name="mobile" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Address:</label>
		              <div class="col-sm-10">
		                <textarea class="form-control input-lg" name="address" required="true"><?=$_POST['address'];?></textarea>
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('addseller-form', '../functions/save-seller.php', 'addseller-response')">Save</button>
		                </span>
		              </div>
		            </div>
		        </form>	
		<?php	
		}
	}
?>