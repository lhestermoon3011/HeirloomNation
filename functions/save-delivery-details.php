<?php
	include "config.php";

	if (isset($_POST)) {
		$chk_acc_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$_POST['acc_id']."'");
		$chk_acc_row = $chk_acc_query->fetch();

		if ($chk_acc_row['acc_id'] == $_POST['acc_id']) {
			$update_query = $conn->prepare("update deliverydetails_tbl set mobile_number = :mobile_number, telephone_number = :telephone_number, address = :address, address_details = :address_details where acc_id = :acc_id");
			$update_query->bindParam(":mobile_number", $_POST['mobile']);
			$update_query->bindParam(":telephone_number", $_POST['telephone']);
			$update_query->bindParam(":address", $_POST['address']);
			$update_query->bindParam(":address_details", $_POST['address_details']);
			$update_query->bindParam(":acc_id", $_POST['acc_id']);

			if ($update_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Delivery Details has been updated.
			</div>
			<form class="row" id="d-detail-form" method="POST">
				<input type="hidden" name="acc_id" value="<?=$_POST['acc_id'];?>">
				<div class="form-group col-lg-6 col-sm-6">
					<label>Mobile Number:</label>
				    <input type="text" class="form-control " name="mobile" value="<?=$_POST['mobile'];?>">
			    </div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Telephone Number:</label>
				    <input type="text" class="form-control " name="telephone" value="<?=$_POST['telephone'];?>">
				</div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Address:</label>
					<textarea class="form-control " name="address"><?=$_POST['address'];?></textarea>
				</div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Address Details:</label>
					<textarea class="form-control " name="address_details"><?=$_POST['address_details'];?></textarea>
				</div>
				<div class="form-group col-lg-12 col-sm-12">
					<button type="submit" class="btn btn-danger " onclick="form_process('d-detail-form', '../functions/save-delivery-details.php', 'd-detail-response')">Update</button>
				</div>
			</form>
			<?php
			}
		}
		else if ($chk_acc_row['acc_id'] != $_POST['acc_id']) {
			$save_query = $conn->prepare("insert into deliverydetails_tbl (acc_id, mobile_number, telephone_number, address, address_details)values(:acc_id, :mobile_number, :telephone_number, :address, :address_details)");
			$save_query->bindParam(":acc_id", $_POST['acc_id']);
			$save_query->bindParam(":mobile_number", $_POST['mobile']);
			$save_query->bindParam(":telephone_number", $_POST['telephone']);
			$save_query->bindParam(":address", $_POST['address']);
			$save_query->bindParam(":address_details", $_POST['address_details']);

			if ($save_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Delivery Details has been saved.
			</div>
			<form class="row" id="d-detail-form" method="POST">
				<input type="hidden" name="acc_id" value="<?=$_POST['acc_id'];?>">
				<div class="form-group col-lg-6 col-sm-6">
					<label>Mobile Number:</label>
				    <input type="text" class="form-control " name="mobile" value="<?=$_POST['mobile'];?>">
			    </div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Telephone Number:</label>
				    <input type="text" class="form-control " name="telephone" value="<?=$_POST['telephone'];?>">
				</div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Address:</label>
					<textarea class="form-control " name="address"><?=$_POST['address'];?></textarea>
				</div>
				<div class="form-group col-lg-6 col-sm-6">
					<label>Address Details:</label>
					<textarea class="form-control " name="address_details"><?=$_POST['address_details'];?></textarea>
				</div>
				<div class="form-group col-lg-12 col-sm-12">
					<button type="submit" class="btn btn-danger " onclick="form_process('d-detail-form', '../functions/save-delivery-details.php', 'd-detail-response')">Save</button>
				</div>
			</form>
			<?php
			}	
		}
	}
?>