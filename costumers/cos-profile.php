<?php include "../functions/account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "cos-navbar.php";?>
<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
	<h3><i class="fa fa-user fa-fw"></i> Profile</h3>
	<hr>
	<div class="row">
		<div class="col-lg-3 col-sm-3">
			<center>
				<div style="height: 270px; width: 100%; overflow-y: hidden;">
					<img src="<?=$cos_row['profile_photo'];?>" class="img-responsive img-rounded img-thumbnail margin-top margin-bottom" style="width: 100%; height: auto;">
				</div>
			</center>
		</div>
		<div class="col-lg-9 col-sm-9">
			<button class="btn btn-warning  pull-right" data-toggle="modal" data-target="#modal-editprofile"><i class="fa fa-edit fa-fw"></i> Edit Profile</button>
			<?php include "../modals/edit-profile.php";?>
			<p class="lead margin-top"><strong>Fullname:</strong> <?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></p>			
			<p class="lead"><strong>Birthdate:</strong> <?=date("F j, Y", strtotime($cos_row['birthdate']));?></p>
			<p class="lead"><strong>Age:</strong> <?=$cos_row['age'];?> Years Old</p>			
			<p class="lead"><strong>Gender:</strong> <?=$cos_row['gender'];?></p>			
			<p class="lead"><strong>Address:</strong> <?=$cos_row['address'];?></p>			
		</div>
	</div>
	<div class="panel panel-default margin-top-lg">
		<div class="panel-body">
			<h3>Delivery Details</h3>
			<p class="text-muted text-small margin-top-sm margin-bottom-lg">This serves as tracking source for to be delivered orders.</p>
			<?php
				$del_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$cos_row['acc_id']."'");
				$del_row = $del_query->fetch();

				if ($del_row['acc_id'] == $cos_row['acc_id']) {
				?>
				<span id="d-detail-response">
				<form class="row" id="d-detail-form" method="POST">
					<input type="hidden" name="acc_id" value="<?=$cos_row['acc_id'];?>">
					<div class="form-group col-lg-6 col-sm-6">
						<label>Mobile Number:</label>
					    <input type="text" class="form-control " name="mobile" value="<?=$del_row['mobile_number'];?>">
				    </div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Telephone Number:</label>
					    <input type="text" class="form-control " name="telephone" value="<?=$del_row['telephone_number'];?>">
					</div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Address:</label>
						<textarea class="form-control " name="address"><?=$del_row['address'];?></textarea>
					</div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Address Details:</label>
						<textarea class="form-control " name="address_details"><?=$del_row['address_details'];?></textarea>
					</div>
					<div class="form-group col-lg-12 col-sm-12">
						<button type="submit" class="btn btn-success " onclick="form_process ('d-detail-form', '../functions/save-delivery-details.php', 'd-detail-response')">Update</button>
					</div>
				</form>
				</span>
				<?php	
				}
				else if ($del_row['acc_id'] != $cos_row['acc_id']) {
				?>
				<span id="d-detail-response">
				<form class="row" id="d-detail-form" method="POST">
					<input type="hidden" name="acc_id" value="<?=$cos_row['acc_id'];?>">
					<div class="form-group col-lg-6 col-sm-6">
						<label>Mobile Number:</label>
					    <input type="text" class="form-control " name="mobile">
				    </div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Telephone Number:</label>
					    <input type="text" class="form-control " name="telephone">
					</div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Address:</label>
						<textarea class="form-control " name="address"></textarea>
					</div>
					<div class="form-group col-lg-6 col-sm-6">
						<label>Address Details:</label>
						<textarea class="form-control " name="address_details"></textarea>
					</div>
					<div class="form-group col-lg-12 col-sm-12">
						<button type="submit" class="btn btn-success " onclick="form_process ('d-detail-form', '../functions/save-delivery-details.php', 'd-detail-response')">Save</button>
						
					</div>
				</form>
				</span>
				<?php	
				}
			?>
		</div>
	</div>	
</div>
<?php include "cos-footer.php";?>
</body>
</html>	