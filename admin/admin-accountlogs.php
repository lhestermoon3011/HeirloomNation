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
			  <li><a class="btn" href="admin-selleraccounts.php">Seller Accounts</a></li>
			  <li><a class="btn" href="admin-useraccounts.php">User Accounts</a></li>
			  <li class="active"><a class="btn" href="admin-accountlogs.php">Account Logs</a></li>
			</ul>
			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Log Type</th>
			        <th>Log Time</th>
			        <th>Firstname</th>
			        <th>Lastname</th>
			        <th>Account Type</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php
			    $cnt_log_query = $conn->query("select count(log_id) as log_id from account_logs");
			   	$cnt_log_row = $cnt_log_query->fetch();

			    if ($cnt_log_row['log_id'] != 0) {
			   		$log_query = $conn->query("select * from account_logs order by log_time desc limit 20");
			   		while ($log_row = $log_query->fetch()) {
			    	$acc_query = $conn->query("select * from accounts_tbl where acc_id = '".$log_row['acc_id']."'");
			    	$acc_row = $acc_query->fetch();

			    		if ($acc_row['acc_type'] == "Admin") {
			    			$user_query = $conn->query("select * from admins_tbl where acc_id = '".$acc_row['acc_id']."'");
			   				while ($user_row = $user_query->fetch()) {
			   				?>
			   				<tr>
					 			<td><?=$log_row['log_type'];?></td>
					 			<td><?=date("F j, Y - h:ia", strtotime($log_row['log_time']));?></td>
					 			<td><?=$user_row['firstname'];?></td>
					 			<td><?=$user_row['lastname'];?></td>
					 			<td><?=$acc_row['acc_type'];?></td>
					 		</tr>
					 		<?php			
			    			}	
			   			}
			   			else if ($acc_row['acc_type'] == "Seller") {
			   				$user_query = $conn->query("select * from sellers_tbl where acc_id = '".$acc_row['acc_id']."'");
			   				while ($user_row = $user_query->fetch()) {
			   				?>
			   				<tr>
					 			<td><?=$log_row['log_type'];?></td>
					 			<td><?=date("F j, Y - h:ia", strtotime($log_row['log_time']));?></td>
					 			<td><?=$user_row['firstname'];?></td>
					 			<td><?=$user_row['lastname'];?></td>
					 			<td><?=$acc_row['acc_type'];?></td>
					 		</tr>
					 		<?php			
			    			}
			   			}
			   			else if ($acc_row['acc_type'] == "Costumer") {
			   				$user_query = $conn->query("select * from costumers_tbl where acc_id = '".$acc_row['acc_id']."'");
			   				while ($user_row = $user_query->fetch()) {
			   				?>
			   				<tr>
					 			<td><?=$log_row['log_type'];?></td>
					 			<td><?=date("F j, Y - h:ia", strtotime($log_row['log_time']));?></td>
					 			<td><?=$user_row['firstname'];?></td>
					 			<td><?=$user_row['lastname'];?></td>
					 			<td><?=$acc_row['acc_type'];?></td>
					 		</tr>
					 		<?php			
			    			}
			   			}	
			    	}
			    }
			    else {
			    ?>
			    	<tr>
				   		<td>No admin created yet.</td>
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