<?php
	include "config.php";

	if (isset($_POST)) {
		$chk_fee_query = $conn->query("select count(fee_id) as fee_id from fees_tbl");
		$chk_fee_row = $chk_fee_query->fetch();

		if ($chk_fee_row['fee_id']  == 0) {
			$save_query = $conn->prepare("insert into fees_tbl (service_fee, delivery_fee)values(:service_fee, :delivery_fee)");
			$save_query->bindParam(":service_fee", $_POST['service_fee']);
			$save_query->bindParam(":delivery_fee", $_POST['delivery_fee']);

			if ($save_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Fees has been updated.
			</div>
			<form id="feesettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">Service Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="service_fee" value="<?=$_POST['service_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Delivery Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="delivery_fee" value="<?=$_POST['delivery_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <button class="btn btn-danger btn-lg" onclick="form_process ('feesettings-form', '../functions/save-fees.php', 'feesettings-response')">Update</button>
	              </div>
	            </div>
	          </form>
			<?php
			}
		}
		else if ($chk_fee_row['fee_id'] != 0) {
			$fee_query = $conn->query("select * from fees_tbl");
			$fee_row = $fee_query->fetch();

			$update_query = $conn->prepare("update fees_tbl set service_fee = :service_fee, delivery_fee = :delivery_fee where fee_id = :fee_id");
			$update_query->bindParam(":service_fee", $_POST['service_fee']);
			$update_query->bindParam(":delivery_fee", $_POST['delivery_fee']);
			$update_query->bindParam(":fee_id", $fee_row['fee_id']);

			if ($update_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Fees has been updated.
			</div>
			<form id="feesettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">Service Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="service_fee" value="<?=$_POST['service_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Delivery Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="delivery_fee" value="<?=$_POST['delivery_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <button class="btn btn-danger btn-lg" onclick="form_process ('feesettings-form', '../functions/save-fees.php', 'feesettings-response')">Update</button>
	              </div>
	            </div>
	          </form>
			<?php
			}
		}
	}
?>