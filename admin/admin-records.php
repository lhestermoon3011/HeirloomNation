<?php include "../functions/admin-account-session.php";?>				
<!DOCTYPE html>
<html>
<head>
	<title>Records &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "admin-navbar.php";?>
	<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
	    <div class="row margin-top" style="margin-bottom: -12px;">
    		<div class="col-lg-6 col-sm-6">
    			<h3 class="pull-left"><i class="fa fa-list fa-fw"></i> Records</h3>
    			<a href="admin-printrecord.php" class="btn btn-warning margin-left pull-left" style="margin-top: 20px;"><i class="fa fa-print fa-fw"></i> Print Order Record</a>
    		</div>
    	</div>
        <div class="clearfix"></div>
		<hr>
		<div class="table table-responsive">
			<table class="table table-hover">
			    <thead>
			      <tr>
			      	<th>Order Details</th>
			        <th>Order Number</th>
			        <th>Item Name</th>
			        <th>Costumer Name</th>
			        <th>Price</th>
			        <th>No. of Items</th>
			        <th>Total Price</th>
			      </tr>
			    </thead>
			    <tbody id="record-container">
				<?php
					$total = 0;
					$order_query = $conn->query("select * from orders_items_tbl inner join orders_tbl on orders_items_tbl.order_id=orders_tbl.order_id order by order_added desc");
					while($order_row = $order_query->fetch()) {
						$item_query = $conn->query("select * from items_tbl where item_id = '".$order_row['item_id']."'");
						$item_row = $item_query->fetch();
						$cart_query = $conn->query("select * from carts_tbl where item_id = '".$order_row['item_id']."'");
						$cart_row = $cart_query->fetch();
						$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$order_row['acc_id']."'");
						$cos_row = $cos_query->fetch();
						$add_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$order_row['acc_id']."'");
						$add_row = $add_query->fetch();
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();

						if ($order_row['item_id'] == $item_row['item_id']) {
							$total += $cart_row['total_price'];
						?>
						<tr>
							<td><button class="btn btn-info" data-toggle="modal" data-target="#modal-orderdetails<?=$order_row['order_id'];?>"><i class="fa fa-external-link-alt fa-fw"></i></button></td>
							<td>Order # <?=$order_row['order_id'];?></td>
							<td><?=$item_row['name'];?></td>
							<td><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></td>
							<td>P<?=$item_row['price'];?></td>
							<td><?=$cart_row['quantity'];?> Items</td>
							<td>P<?=$cart_row['total_price'];?></td>
						</tr>
						<?php include "../modals/order-details.php";?>
						<?php
						}
					}
				?>
				<tr>
					<td class="lead"><strong>TOTAL</strong></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="lead"><strong>P<?php echo number_format($total, 2);?></strong></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>	
<?php include "admin-footer.php";?>
</body>
</html>