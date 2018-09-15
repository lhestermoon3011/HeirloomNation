<?php include "../functions/admin-account-session.php";?>
<?php
	if (!empty($_GET['order_id'])) {
		$order_query = $conn->query("select * from orders_tbl where order_id = '".$_GET['order_id']."'");
		$order_row = $order_query->fetch();
	}
	else {
		header("location: admin-orders.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Receipt &bull; HeirloomNation</title>
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
		<a href="admin-orders.php" class="btn btn-info btn-lg"><i class="fa fa-arrow-left"></i> Return</a>
		<button class="btn btn-info btn-lg" onclick="print_function ('printarea')"><i class="fa fa-print fa-fw"></i>Print Receipt</button>
		<div class="panel panel-default padding-top-lg padding-bottom-lg margin-top-lg" id="printarea">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-8">
						<center>
							<img src="../web-images/hn-logo.png" class="img-responsive" style="height: 100px; width: auto;">
							<p>OFFICIAL RECEIPT</p>
							<p class="text-center margin-top-lg margin-bottom-lg"><?=date("Y/m/d");?> (<?=date("l");?>) - <?=date("h:i:s");?></p>
						</center>
						<table class="table table-responsive">
							<tr>
								<th>Order # <?=$order_row['order_id'];?> &bull; Delivery Date: <?=date("F j, Y", strtotime($order_row['order_deliverydate']));?> &bull; Pay via: <?=$order_row['payment_type'];?></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>Item Name</th>
								<th>Price</th>
								<th>No. of Items</th>
								<th>Total Price</th>
							</tr>
							<tr>
							<?php
								$cart_total = 0;
								$order_items_query = $conn->query("select * from orders_items_tbl where order_id = '".$order_row['order_id']."'");
						     	while ($order_items_row = $order_items_query->fetch()) {
						     		$item_query = $conn->query("select * from items_tbl inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where item_id = '".$order_items_row['item_id']."'");
				          			while($item_row = $item_query->fetch()) {
				          				$cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and cart_status = 'Checkout'");
				          				$cart_row = $cart_query->fetch();
				          				$total_price = str_replace(",", "", $cart_row['total_price']);
								        $cart_total += $total_price;
				          		?>
				          		<tr>
				          			<td><?=$item_row['name'];?></td>
				          			<td>P<?=$item_row['price'];?></td>
				          			<td><?=$cart_row['quantity'];?> Items</td>
				          			<td>P<?=$cart_row['total_price'];?></td>
				          		</tr>
				          		<?php	
				          			}
				          		}
				          		$fee_query = $conn->query("select * from fees_tbl");
								$fee_row = $fee_query->fetch();

								$total_payment = $cart_total + $fee_row['service_fee'] + $fee_row['delivery_fee'];
							?>
								<tr>
									<td><strong>Cart Total</strong></td>
									<td></td>
									<td></td>
									<td>P<?=number_format($cart_total, 2);?></td>
								</tr>
								<tr>
									<td><strong>Service Fee</strong></td>
									<td></td>
									<td></td>
									<td>P<?=number_format($fee_row['service_fee'], 2);?></td>
								</tr>
								<tr>
									<td><strong>Delivery Fee</strong></td>
									<td></td>
									<td></td>
									<td>P<?=number_format($fee_row['delivery_fee'], 2);?></td>
								</tr>
								<tr>
									<td><strong>Total Payment</strong></td>
									<td></td>
									<td></td>
									<td>P<?=number_format($total_payment, 2);?></td>
								</tr>
							</tr>
						</table>
						<?php
							$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$order_row['acc_id']."'");
							$cos_row = $cos_query->fetch();
							$detail_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$order_row['acc_id']."'");
							$detail_row = $detail_query->fetch();
						?>
						<div class="margin-top-lg row">
							<hr>
							<div class="col-lg-2 col-sm-2"></div>
							<div class="col-lg-8 col-sm-8">
								<div class="col-lg-5 col-sm-5">
						   		<p class="text-left"><strong>Costumer Name:</strong>
							   </div>
							   <div class="col-lg-7 col-sm-7">
							   		<p class="text-right"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></p>
							   </div>
							   <div class="col-lg-5 col-sm-5">
							   		<p class="text-left"><strong>Mobile Number:</strong>
							   </div>
							   <div class="col-lg-7 col-sm-7">
							   		<p class="text-right"><?=$detail_row['mobile_number'];?></p>
							   </div>
							   <div class="col-lg-5 col-sm-5">
							   		<p class="text-left"><strong>Telephone Number:</strong>
							   </div>
							   <div class="col-lg-7 col-sm-7">
							   		<p class="text-right"><?=$detail_row['telephone_number'];?></p>
							   </div>
							   <div class="clearfix"></div>
							   <div class="col-lg-5 col-sm-5">
							   		<p class="text-left"><strong>Address:</strong>
							   </div>
							   <div class="col-lg-7 col-sm-7">
							   		<p class="text-right"><?=$detail_row['address'];?></p>
							   </div>
							   <div class="col-lg-5 col-sm-5">
							   		<p class="text-left"><strong>Address Details:</strong>
							   </div>
							   <div class="col-lg-7 col-sm-7">
							   		<p class="text-justify"><?=$detail_row['address_details'];?></p>
							   </div>	
							</div>
							<div class="col-lg-2 col-sm-2"></div>
						</div>
						<div style="margin-top: 30px;">
							<p class="text-center padding-top">&copy; HeirloomNation 2018. All Rights Reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>