<?php include "../functions/seller-account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Seller Dashboard &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "seller-navbar.php";?>
	<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
	    <h3><i class="fa fa-home fa-fw"></i> Dashboard</h3>
		<hr>
		<div class="row">
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$seller_row['acc_id']."'");
					$cnt_row = $cnt_query->fetch();
				?>
				<div class="panel btn-warning">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #d2691e; color: #ffffff;">
						<center><i class="fa fa-th fa-6x"></i></center>
						<p class="lead text-center">You have a total of <?=$cnt_row['item_id'];?> items in your inventory.</p>
						<center>
							<a href="seller-inventory.php" class="btn btn-warning btn-lg">See Inventory <i class="fa fa-chevron-right fa-fw"></i></a>
						</center>
					</div>
				</div>		
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$total = 0;
					$order_query = $conn->query("select * from orders_items_tbl inner join orders_tbl on orders_items_tbl.order_id=orders_tbl.order_id");
					while($order_row = $order_query->fetch()) {
						$item_query = $conn->query("select * from items_tbl where item_id = '".$order_row['item_id']."' and seller_id = '".$acc_id."'");
						$item_row = $item_query->fetch();
						$cart_query = $conn->query("select * from carts_tbl where item_id = '".$order_row['item_id']."'");
						$cart_row = $cart_query->fetch();
						$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$order_row['acc_id']."'");
						$cos_row = $cos_query->fetch();
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();

						if ($order_row['item_id'] == $item_row['item_id']) {
							$total += $cart_row['total_price'];
						?>
						<?php
						}
					}
				?>
				<div class="panel btn-info">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #95dee3; color: #ffffff;">
						<center><i class="fa fa-money-bill-alt fa-6x"></i></center>
						<p class="lead text-center">You have earned P<?=number_format($total, 2);?> from items you sold.</p>
						<center>
							<a href="seller-records.php" class="btn btn-info btn-lg">See Records <i class="fa fa-chevron-right fa-fw"></i></a>
						</center>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-4">
				<?php
					$cnt_query2 = $conn->query("select count(seller) as seller from messages_tbl where seller = '".$acc_id."'");
					$cnt_row2 = $cnt_query2->fetch();
				?>
				<div class="panel btn-success">
					<div class="panel-body padding-top-lg padding-bottom-lg" style="background: #79c753; color: #ffffff;">
						<center><i class="fa fa-comments fa-6x"></i></center>
						<p class="lead text-center">You have a total of <?=$cnt_row2['seller'];?> conversations with the costumers.</p>
							<center>
								<a href="seller-message.php" class="btn btn-success btn-lg">See Messages <i class="fa fa-chevron-right fa-fw"></i></a>
							</center>
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php include "seller-footer.php";?>	
</body>
</html>	