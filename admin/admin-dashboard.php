<?php include "../functions/admin-account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "admin-navbar.php";?>
	<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
	    <h3><i class="fa fa-home fa-fw"></i> Dashboard</h3>
		<hr>
		<div class="row">
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query = $conn->query("select count(item_id) as item_id from items_tbl");
					$cnt_row = $cnt_query->fetch();
				?>
				<div class="panel btn-warning">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #d2691e; color: #ffffff;">
						<center><i class="fa fa-th fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row['item_id'];?> items in the inventory.</p>
						<center>
							<a href="admin-inventory.php" class="btn btn-warning btn-lg">See Inventory <i class="fa fa-chevron-right fa-fw"></i></a>
						</center>
					</div>
				</div>		
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query2 = $conn->query("select count(order_id) as order_id from orders_tbl where order_status = 'To Be Delivered'");
					$cnt_row2 = $cnt_query2->fetch();
				?>
				<div class="panel btn-info">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #95dee3; color: #ffffff;">
						<center><i class="fa fa-truck fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row2['order_id'];?> orders that is to be delivered.</p>
						<center>
							<a href="admin-orders.php" class="btn btn-info btn-lg">See 'To be Delivered' Orders <i class="fa fa-chevron-right fa-fw"></i></a>
						</center>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query3 = $conn->query("select count(order_id) as order_id from orders_tbl where order_status = 'Finished'");
					$cnt_row3 = $cnt_query3->fetch();
				?>
				<div class="panel btn-success">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #79c753; color: #ffffff;">
						<center><i class="fa fa-check fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row3['order_id'];?> orders that is finished.</p>
							<center>
								<a href="admin-orders.php" class="btn btn-success btn-lg">See 'Finished' Orders <i class="fa fa-chevron-right fa-fw"></i></a>
							</center>
					</div>
				</div>	
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query4 = $conn->query("select count(orders_items_id) as orders_items_id from orders_items_tbl");
					$cnt_row4 = $cnt_query4->fetch();
				?>
				<div class="panel btn-primary">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #004B8D; color: #ffffff;">
						<center><i class="fa fa-shopping-bag fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row4['orders_items_id'];?> orders recorded.</p>
							<center>
								<a href="admin-records.php" class="btn btn-primary btn-lg">See Records <i class="fa fa-chevron-right fa-fw"></i></a>
							</center>
					</div>
				</div>	
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query5 = $conn->query("select count(acc_id) as acc_id from sellers_tbl");
					$cnt_row5 = $cnt_query5->fetch();
				?>
				<div class="panel btn-danger">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #DC4C46; color: #ffffff;">
						<center><i class="fa fa-user-plus fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row5['acc_id'];?> sellers to post selled items.</p>
							<center>
								<a href="admin-selleraccounts.php" class="btn btn-danger btn-lg">See Seller Accounts <i class="fa fa-chevron-right fa-fw"></i></a>
							</center>
					</div>
				</div>	
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query6 = $conn->query("select count(acc_id) as acc_id from costumers_tbl");
					$cnt_row6 = $cnt_query6->fetch();
				?>
				<div class="panel btn-default">
					<div class="panel-body padding-top-lg padding-bottom-lg">
						<center><i class="fa fa-users fa-6x"></i></center>
						<p class="lead text-center">The system have a total of <?=$cnt_row6['acc_id'];?> users to buy selled items.</p>
							<center>
								<a href="admin-useraccounts.php" class="btn btn-default btn-lg">See User Accounts <i class="fa fa-chevron-right fa-fw"></i></a>
							</center>
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php include "admin-footer.php";?>	
</body>
</html>	