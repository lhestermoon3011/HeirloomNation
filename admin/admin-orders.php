<?php include "../functions/admin-account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Orders &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "admin-navbar.php";?>
	<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
		<div class="margin-top row" style="margin-bottom: -12px;">
    		<div class="col-lg-6 col-sm-6">
    			<h3 class="pull-left"><i class="fa fa-calendar-plus fa-fw"></i> Orders</h3>
    			<button class="btn btn-warning margin-left pull-left" data-toggle="modal" data-target="#modal-feesettings" style="margin-top: 20px;"><i class="fa fa-money-bill-alt fa-fw"></i> Fee Settings</button>
    		</div>
    		<div class="col-lg-6 col-sm-6">	
				<div class="btn-group pull-right margin-top-lg">
					<div class="input-group search-unextended pull-left">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
					    <input type="text" class="form-control" name="search" placeholder="Search orders..." onkeyup="load_process ('order-container', '../functions/search-module.php?search-order='+this.value)" autocomplete="off">
					</div>
				</div>	
			</div>	
    	</div>
        <div class="clearfix"></div>
		<hr>
		<?php include "../modals/fee-settings.php";?>
		<div id="order-container">
			<?php
				$cnt_order_query = $conn->query("select count(order_id) as order_id from orders_tbl");
				$cnt_order_row = $cnt_order_query->fetch();

				if ($cnt_order_row['order_id'] != 0) {
					$cnt_order_query = $conn->query("select count(order_id) as order_id from orders_tbl where order_status = 'To be Delivered'");
					$cnt_order_row = $cnt_order_query->fetch();

					if (!empty($cnt_order_row['order_id'])) {
						$order_query = $conn->query("select * from orders_tbl where order_status = 'To be Delivered' order by order_added desc");
						?>
						<h4>To Be Delivered Orders</h4>
						<?php
						while ($order_row = $order_query->fetch()) {
							$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$order_row['acc_id']."'");
						    $cos_row = $cos_query->fetch();

						    $add_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$order_row['acc_id']."'");
						    $add_row = $add_query->fetch();
						?>
						<div class="panel-group" id="accordion">
						  <div class="panel panel-info">
						    <div class="panel-heading">
						      <a href="../functions/confirm-order.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg btn-info pull-right margin-top">Confirm Order Received <i class="fa fa-check fa-fw"></i></a>
						      <a href="admin-printreceipt.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Print Receipt <i class="fa fa-print fa-fw"></i></a>
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
						      <h4 class="margin-top margin-bottom-sm">Order # <?=$order_row['order_id'];?>
						      	<?php
						      		$today = date("Y-m-d", strtotime("today"));
						      		if (date("Y-m-d", strtotime($order_row['order_deliverydate'])) == $today) {
						      		?>
						      		<span class="badge">Delivery Due Today</span>
						      		<?php
						      		}
						      		else if (date("Y-m-d", strtotime($order_row['order_deliverydate'])) < $today) {
						      		?>
						      		<span class="badge">Delivery Due Already Passed <i class="fa fa-exclamation-triangle fa-fw"></i></span>
						      		<?php	# code...
						      		}
						      	?>
						      </h4>
						      <p class="text-small"><i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($order_row['order_added']));?> &bull; Payment via <?=$order_row['payment_type'];?> &bull; <?=$order_row['order_status'];?></p>
						    </div>
						    <div id="collapse<?=$order_row['order_id'];?>" class="panel-collapse collapse">
						 	  <div class="panel-body">
						 		<div class="row">
						 			<div class="col-lg-8 col-sm-8">
						 			<?php
							 			$cart_total = 0;
							 			$cnt_item_query = $conn->query("select count(orders_items_id) as orders_items_id from orders_items_tbl where order_id = '".$order_row['order_id']."'");
								        $cnt_item_row = $cnt_item_query->fetch();
							 			$order_items_query = $conn->query("select * from orders_items_tbl where order_id = '".$order_row['order_id']."'");
								     	while ($order_items_row = $order_items_query->fetch()) {
								     		$item_query = $conn->query("select * from items_tbl inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where item_id = '".$order_items_row['item_id']."'");
						          			while($item_row = $item_query->fetch()) {
						          				$cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and cart_status = 'Checkout'");
						          				$cart_row = $cart_query->fetch();
						          				$total_price = str_replace(",", "", $cart_row['total_price']);
										        $cart_total += $total_price;
						          				?>
						          				<div class="row margin-bottom-lg">
								                 <div class="col-lg-3 col-lg-3">
								                    <div class="border" style="height: 175px; overflow: hidden;">
								                      <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
								                    </div>
								                 </div>
								                 <div class="col-lg-5 col-lg-5">
								                    <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
								                      <p class="text-small text-muted margin-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
								                      <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								                 </div>
								                 <div class="col-lg-2 col-lg-2">
									                <label class="margin-top">No. of items:</label>
									                <p class="margin-top-sm lead"><?=$cart_row['quantity'];?></p>
									             </div>
									             <div class="col-lg-2 col-lg-2">
									                <label class="margin-top">Total Price:</label>
									                <p class="margin-top-sm lead">P<?=$cart_row['total_price'];?></p>
									             </div>
								            	</div> 
						          			<?php	
						          			}
								     	}
								     	$fee_query = $conn->query("select * from fees_tbl");
										$fee_row = $fee_query->fetch();

										$total_payment = $cart_total + $fee_row['service_fee'] + $fee_row['delivery_fee'];	
							 			?>
						 			</div>
						 			<div class="col-lg-4 col-sm-4">
						 				<h3 class="margin-top-sm margin-bottom">Order Summary</h3>
						 				<p><span class="pull-left"><strong>Cart Total:</strong> (<?=$cnt_item_row['orders_items_id'];?> Items)</span>
										<span class="pull-right">P<?php echo number_format($cart_total, 2);?></span>
										</p>
										<div class="clearfix"></div>
										<p><strong class="pull-left">Service Fee:</strong> <span class="pull-right">P<?php echo number_format($fee_row['service_fee'], 2);?></span></p>
										<div class="clearfix"></div>
										<p><strong class="pull-left">Delivery Fee:</strong><span class="pull-right">P<?php echo number_format($fee_row['delivery_fee'], 2);?></span></p>
										<div class="clearfix padding-bottom border-bottom"></div>
										<p><strong class="pull-left">Total Payment:</strong><span class="pull-right">P<?php echo number_format($total_payment, 2);?></span></p>
										<div class="clearfix padding-bottom"></div>
										<h3 class="margin-top-lg margin-bottom">Payment & Order Details</h3>
										<p><span class="pull-left"><strong>Payment Via:</strong></span>
										<span class="pull-right"><?=$order_row['payment_type'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Order Status:</strong></span>
										<span class="pull-right"><?=$order_row['order_status'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Delivery Date:</strong></span>
										<span class="pull-right"><?=date("F j, Y", strtotime($order_row['order_deliverydate']));?></span></p>
										<div class="clearfix padding-bottom"></div>
										<h3 class="margin-top-lg margin-bottom">Costumer Details</h3>
										<p><span class="pull-left"><strong>Fullname:</strong></span>
										<span class="pull-right"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Mobile Number:</strong></span>
										<span class="pull-right"><?=$add_row['mobile_number'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Telephone Number:</strong></span>
										<span class="pull-right"><?=$add_row['telephone_number'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Delivery Address:</strong></span>
										<span class="pull-right"><?=$add_row['address'];?></span></p>
										<div class="clearfix"></div>
										<p><strong>Address Details:</strong></p>
										<p class="text-justify" style="margin-top: -12px;"><?=$add_row['address_details'];?></p>
						 			</div>
						 		</div>
						 	  </div>
						    </div>
						  </div>
						</div> 
						<?php
						}
					}
					$cnt_order_query2 = $conn->query("select count(order_id) as order_id from orders_tbl where order_status = 'Finished'");
					$cnt_order_row2 = $cnt_order_query2->fetch();

					if (!empty($cnt_order_row2['order_id'])) {
						$order_query = $conn->query("select * from orders_tbl where order_status = 'Finished' order by order_added desc");
						?>
						<h4>Finished Orders</h4>
						<?php
						while ($order_row = $order_query->fetch()) {
							$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$order_row['acc_id']."'");
						    $cos_row = $cos_query->fetch();

						    $add_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$order_row['acc_id']."'");
						    $add_row = $add_query->fetch();

						?>
						<div class="panel-group" id="accordion">
						  <div class="panel panel-default">
						    <div class="panel-heading">
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
						      <h4 class="margin-top margin-bottom-sm">Order # <?=$order_row['order_id'];?></a></h4>
						      <p class="text-small"><i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($order_row['order_added']));?> &bull; Payment via <?=$order_row['payment_type'];?> &bull; <?=$order_row['order_status'];?></p>
						    </div>
						    <div id="collapse<?=$order_row['order_id'];?>" class="panel-collapse collapse">
						 	  <div class="panel-body">
						 		<div class="row">
						 			<div class="col-lg-8 col-sm-8">
						 			<?php
							 			$cart_total = 0;
							 			$cnt_item_query = $conn->query("select count(orders_items_id) as orders_items_id from orders_items_tbl where order_id = '".$order_row['order_id']."'");
								        $cnt_item_row = $cnt_item_query->fetch();
							 			$order_items_query = $conn->query("select * from orders_items_tbl where order_id = '".$order_row['order_id']."'");
								     	while ($order_items_row = $order_items_query->fetch()) {
								     		$item_query = $conn->query("select * from items_tbl inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where item_id = '".$order_items_row['item_id']."'");
						          			while($item_row = $item_query->fetch()) {
						          				$cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and cart_status = 'Checkout'");
						          				$cart_row = $cart_query->fetch();
						          				$total_price = str_replace(",", "", $cart_row['total_price']);
										        $cart_total += $total_price;
						          				?>
						          				<div class="row margin-bottom-lg">
								                 <div class="col-lg-3 col-lg-3">
								                    <div class="border" style="height: 175px; overflow: hidden;">
								                      <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
								                    </div>
								                 </div>
								                 <div class="col-lg-5 col-lg-5">
								                    <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
								                      <p class="text-small text-muted margin-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
								                      <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								                 </div>
								                 <div class="col-lg-2 col-lg-2">
									                <label class="margin-top">No. of items:</label>
									                <p class="margin-top-sm lead"><?=$cart_row['quantity'];?></p>
									             </div>
									             <div class="col-lg-2 col-lg-2">
									                <label class="margin-top">Total Price:</label>
									                <p class="margin-top-sm lead">P<?=$cart_row['total_price'];?></p>
									             </div>
								            	</div> 
						          			<?php	
						          			}
								     	}
								     	$fee_query = $conn->query("select * from fees_tbl");
										$fee_row = $fee_query->fetch();

										$total_payment = $cart_total + $fee_row['service_fee'] + $fee_row['delivery_fee'];	
							 			?>
						 			</div>
						 			<div class="col-lg-4 col-sm-4">
						 				<h3 class="margin-top-sm margin-bottom">Order Summary</h3>
						 				<p><span class="pull-left"><strong>Cart Total:</strong> (<?=$cnt_item_row['orders_items_id'];?> Items)</span>
										<span class="pull-right">P<?php echo number_format($cart_total, 2);?></span>
										</p>
										<div class="clearfix"></div>
										<p><strong class="pull-left">Service Fee:</strong> <span class="pull-right">P<?php echo number_format($fee_row['service_fee'], 2);?></span></p>
										<div class="clearfix"></div>
										<p><strong class="pull-left">Delivery Fee:</strong><span class="pull-right">P<?php echo number_format($fee_row['delivery_fee'], 2);?></span></p>
										<div class="clearfix padding-bottom border-bottom"></div>
										<p><strong class="pull-left">Total Payment:</strong><span class="pull-right">P<?php echo number_format($total_payment, 2);?></span></p>
										<div class="clearfix padding-bottom"></div>
										<h3 class="margin-top-lg margin-bottom">Payment & Order Details</h3>
										<p><span class="pull-left"><strong>Payment Via:</strong></span>
										<span class="pull-right"><?=$order_row['payment_type'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Order Status:</strong></span>
										<span class="pull-right"><?=$order_row['order_status'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Delivery Date:</strong></span>
										<span class="pull-right"><?=date("F j, Y", strtotime($order_row['order_deliverydate']));?></span></p>
										<div class="clearfix padding-bottom"></div>
										<h3 class="margin-top-lg margin-bottom">Costumer Details</h3>
										<p><span class="pull-left"><strong>Fullname:</strong></span>
										<span class="pull-right"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Mobile Number:</strong></span>
										<span class="pull-right"><?=$add_row['mobile_number'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Telephone Number:</strong></span>
										<span class="pull-right"><?=$add_row['telephone_number'];?></span></p>
										<div class="clearfix"></div>
										<p><span class="pull-left"><strong>Delivery Address:</strong></span>
										<span class="pull-right"><?=$add_row['address'];?></span></p>
										<div class="clearfix"></div>
										<p><strong>Address Details:</strong></p>
										<p class="text-justify" style="margin-top: -12px;"><?=$add_row['address_details'];?></p>
						 			</div>
						 		</div>
						 	  </div>
						    </div>
						  </div>
						</div> 
						<?php
						}
					}	
				}
				else {
				?>
		          <div class="panel panel-default">
		            <div class="panel-body text-center">
		              <i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
		              <p class="lead">You must checkout your order before checking progress of your orders.</p>
		            </div>
		          </div>
				<?php
				}
			?>
		</div>
	</div>
<?php include "admin-footer.php";?>	
</body>
</html>	