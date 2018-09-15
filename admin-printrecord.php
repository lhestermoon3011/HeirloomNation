<?php include "../functions/admin-account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Record &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
	<script type="text/javascript">
	  	function print_function (printarea) {
	  		var printContents = document.getElementById(printarea).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = "<div id = '"+ printarea +"'>" + printContents + "</div>";
	  		window.print();
	  	}
	</script>
</head>
<body>
	<div class="container margin-top-lg">
		<a href="admin-records.php" class="btn btn-info btn-lg"><i class="fa fa-arrow-left"></i> Return</a>
		<button class="btn btn-info btn-lg" onclick="print_function ('printarea')"><i class="fa fa-print fa-fw"></i>Print Record</button>
		<div class="panel panel-default padding-top-lg padding-bottom-lg margin-top-lg" id="printarea">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<center>
							<img src="../web-images/hn-logo.png" class="img-responsive" style="height: 100px; width: auto;">
							<p class="margin-bottom-lg">OFFICIAL RECORD as of <?=date("Y/m/d");?> (<?=date("l");?>) - <?=date("h:i:s");?></p>
						</center>
						<table class="table table-responsive">
							<thead>
						      <tr>
						        <th>Order Number</th>
						        <th>Item Name</th>
						        <th>Costumer Name</th>
						        <th>Price</th>
						        <th>No. of Items</th>
						        <th>Total Price</th>
						      </tr>
						    </thead>
						    <tbody>
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
											<td>Order # <?=$order_row['order_id'];?></td>
											<td><?=$item_row['name'];?></td>
											<td><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></td>
											<td>P<?=$item_row['price'];?></td>
											<td><?=$cart_row['quantity'];?> Items</td>
											<td>P<?=$cart_row['total_price'];?></td>
										</tr>
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
									<td class="lead"><strong>P<?php echo number_format($total, 2);?></strong></td>
								</tr>
						    </tbody>
						</table>
						<div style="margin-top: 60px;">
							<p class="text-center padding-top">&copy; HeirloomNation 2018. All Rights Reserved.</p>
						</div>
					</div>
					<div class="col-lg-1"></div>
				</div>	
			</div>			
		</div>
	</div>
</body>
</html>