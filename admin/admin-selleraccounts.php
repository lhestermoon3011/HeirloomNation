<?php include "../functions/admin-account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Accounts &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "admin-navbar.php";?>
    <div class="container"  style="margin-top: 50px; margin-bottom: 75px;">
		<h2><i class="fa fa-users fa-fw"></i> Accounts</h2>
			<hr>
			<ul class="nav nav-pills nav-justified margin-bottom-lg">
			  <li><a class="btn" href="admin-accounts.php">Admin Accounts</a></li>
			  <li class="active"><a class="btn" href="admin-selleraccounts.php">Seller Accounts</a></li>
			  <li><a class="btn" href="admin-useraccounts.php">User Accounts</a></li>
			  <li><a class="btn" href="admin-accountlogs.php">Account Logs</a></li>
			</ul>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<a data-toggle="modal" data-target="#modal-addaccount" class="btn btn-warning margin-bottom-lg"><i class="fa fa-plus fa-fw"></i> Add Seller</a>	
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="input-group search-unextended pull-left">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
					    <input type="text" class="form-control" name="search" placeholder="Search seller..." onkeyup="load_process ('seller-container', '../functions/search-module.php?search-seller-2='+this.value)" autocomplete="off">
					</div>
				</div>
			</div>
			<?php
				include "../modals/add-seller.php";
			?>
			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Account ID</th>
			        <th>E-mail</th>
			        <th>Password</th>
			        <th>Firstname</th>
			        <th>Lastname</th>
			        <th>Account Created</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody id="seller-container">
			    <?php
			    	$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Seller'");
					$cnt_acc_row = $cnt_acc_query->fetch();

					if ($cnt_acc_row['acc_id'] != 0) {
			    	$account_query = $conn->query("select * from accounts_tbl inner join sellers_tbl on accounts_tbl.acc_id = sellers_tbl.acc_id where acc_type = 'Seller'");
				    	while ($account_row = $account_query->fetch()) {
				    	?>
				    	<tr id="<?=$account_row['acc_id'];?>">
				    		<td><?=$account_row['acc_id'];?></td>
				    		<td><?=$account_row['email'];?></td>
				    		<td><?=$account_row['password'];?></td>
				    		<td><?=$account_row['firstname'];?></td>
				    		<td><?=$account_row['lastname'];?></td>
				    		<td><?=date("F j, Y - h:ia", strtotime($account_row['acc_created']));?></td>
				    		<td>
				    			<?php
				    				if ($account_row['acc_status'] == "Activated") {
				    				?>
					    				<a href="javascript:void(0)" onclick="load_process('btn-status<?=$account_row['acc_id'];?>', '../functions/update-account-status.php?acc_id=<?=$account_row['acc_id'];?>')" class="btn btn-info btn-block" id="btn-status<?=$account_row['acc_id'];?>"><i class="fa fa-times fa-fw"></i> Deactivate</a>
					    			<?php
				    				}
				    				else {
				    				?>
					    				<a href="javascript:void(0)" onclick="load_process('btn-status<?=$account_row['acc_id'];?>', '../functions/update-account-status.php?acc_id=<?=$account_row['acc_id'];?>')" class="btn btn-info btn-block" id="btn-status<?=$account_row['acc_id'];?>"><i class="fa fa-check fa-fw"></i> Activate</a>
					    			<?php	
				    				}	
				    			?>
				    		</td>
				    	</tr>
				    	<?php	
				    	}
				    }
				    else {
				    	?>
				    	<tr>
				    		<td>No seller created yet.</td>
				    	</tr>
				    	<?php
				    }
			    ?>	
			    </tbody>
			</table>      
		</div>
	</div>
<?php include "admin-footer.php";?>	
</body>
</html>		