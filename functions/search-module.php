<?php
	include "config.php";
	include "admin-account-session.php";

	if (isset($_GET['search-seller'])) {
		if (!empty($_GET['search-seller'])) {
			$cnt_seller_query = $conn->query("select count(acc_id) as acc_id from sellers_tbl where firstname like '%".$_GET['search-seller']."%' or lastname like '%".$_GET['search-seller']."%'");
			$cnt_seller_row = $cnt_seller_query->fetch();

			if ($cnt_seller_row['acc_id'] != 0) {
			?>
			<p><strong>Results: </strong><?=$cnt_seller_row['acc_id'];?> results for <strong><?=$_GET['search-seller'];?></strong></p>
			<?php
				$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id where firstname like '%".$_GET['search-seller']."%' or lastname like '%".$_GET['search-seller']."%' order by firstname asc");
				while ($seller_row = $seller_query->fetch()) {
				?>
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="index.php?acc_id=<?=$seller_row['acc_id'];?>" class="btn btn-warning btn-lg pull-right">View Seller Items  <i class="fa fa-chevron-right"></i></a>
						<a href="cos-message.php?seller_id=<?=$seller_row['acc_id'];?>" class="btn btn-warning btn-lg pull-right">Message Seller <i class="fa fa-envelope"></i></a>
						<p class="lead margin-bottom-sm"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						<p class="text-small text-muted" style="margin-top: -7px;"><?=$seller_row['email'];?> &bull; <?=$seller_row['mobile_number'];?> &bull; <?=$seller_row['address'];?></p>
					</div>
				</div>	
				<?php
				}
			}
			else {
			?>
			<p><strong>Results: </strong>No results for <strong><?=$_GET['search-seller'];?></strong></p>
			<?php	
			}
		}
		else {
			$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id order by firstname asc");
			while ($seller_row = $seller_query->fetch()) {
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="index.php?acc_id=<?=$seller_row['acc_id'];?>" class="btn btn-info btn-lg pull-right">View Seller Items  <i class="fa fa-chevron-right"></i></a>
					<a href="cos-message.php?acc_id=<?=$seller_row['acc_id'];?>" class="btn btn-info btn-lg pull-right">Message Seller <i class="fa fa-envelope"></i></a>
					<p class="lead margin-bottom-sm"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
					<p class="text-small text-muted" style="margin-top: -7px;"><?=$seller_row['email'];?> &bull; <?=$seller_row['mobile_number'];?> &bull; <?=$seller_row['address'];?></p>
				</div>
			</div>	
			<?php
			}
		}
	}

	if (isset($_GET['search-item'])) {
		if (!empty($_GET['search-item'])) {
		?>
		<div class="panel panel-default" style="position: absolute; width: 97%; z-index: 1; height: 300px; overflow-y: auto;">
			<div class="panel-body">
			<?php
				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where name like '%".$_GET['search-item']."%'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<p><strong>Results:</strong> <?=$cnt_item_row['item_id'];?> results for <strong>'<?=$_GET['search-item'];?>'</strong></p>
				<div class="panel-group">
				<?php	
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where name like '%".$_GET['search-item']."%' order by rand() asc");
					while ($item_row = $item_query->fetch()) {
						if ($item_row['quantity'] != 0) {
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<h4 class="margin-bottom-sm pull-left"><?=$item_row['name'];?></h4>
								<p class="pull-left" style="margin-top: 11px; margin-left: 7px;">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
								<div class="clearfix"></div>
								<p class="pull-left" style="margin-top: -7px;"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								<a href="cos-item.php?item_id=<?=$item_row['item_id'];?>" class="btn btn-warning btn-lg pull-right" style="margin-top: -32px;">Item Details <i class="fa fa-chevron-right fa-fw"></i></a>
							</div>
						</div>		
						<?php
						}
						else {
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<h4 class="margin-bottom-sm pull-left"><?=$item_row['name'];?></h4>
								<p class="pull-left" style="margin-top: 11px; margin-left: 7px;">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?> <span class="label label-danger">Sold Out</span></p>
								<div class="clearfix"></div>
								<p class="pull-left" style="margin-top: -7px;"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								<a href="cos-item.php?item_id=<?=$item_row['item_id'];?>" class="btn btn-warning btn-lg pull-right" style="margin-top: -32px;">Item Details <i class="fa fa-chevron-right fa-fw"></i></a>
							</div>
						</div>		
						<?php	
						}
					}
				?>
				</div>
				<?php	
				}
				else {
				?>
				<p><strong>Results:</strong> No results for <strong>'<?=$_GET['search-item'];?>'</strong></p>
				<?php	
				}
			?>
			</div>
		</div>
		<?php	
		}
	}

	if (isset($_GET['search-item-2'])) {
		if (!empty($_GET['search-item-2'])) {
			$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where name like '%".$_GET['search-item-2']."%'");
			$cnt_item_row = $cnt_item_query->fetch();

			if ($cnt_item_row['item_id'] != 0) {
			?>
			<p class="lead"><strong>Results: </strong><?=$cnt_item_row['item_id'];?> results for <strong><?=$_GET['search-item-2'];?></strong></p>
			<div class="row">
			<?php
				if ($cnt_item_row['item_id'] != 0) {
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where name like '%".$_GET['search-item-2']."%'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="admin-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>
					<?php
					}
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
			?>
			</div>
			<?php	
			}
			else {
			?>
			<p class="lead"><strong>Results: </strong>No results for <strong><?=$_GET['search-item-2'];?></strong></p>
			<?php	
			}
		}
		else {
				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<div class="row">
				<?php
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="admin-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>	
					<?php
					}
				?>
				</div>
				<?php			
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
		}
	}

	if (isset($_GET['cat_id']) && isset($_GET['search-item-3'])) {
		if (!empty($_GET['search-item-3'])) {
			$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where name like '%".$_GET['search-item-3']."%' and cat_id = '".$_GET['cat_id']."'");
			$cnt_item_row = $cnt_item_query->fetch();

			if ($cnt_item_row['item_id'] != 0) {
			?>
			<p class="lead"><strong>Results: </strong><?=$cnt_item_row['item_id'];?> results for <strong><?=$_GET['search-item-3'];?></strong></p>
			<div class="row">
			<?php
				if ($cnt_item_row['item_id'] != 0) {
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where name like '%".$_GET['search-item-3']."%' and cat_id = '".$_GET['cat_id']."'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="admin-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>
					<?php
					}
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
			?>
			</div>
			<?php	
			}
			else {
			?>
			<p class="lead"><strong>Results: </strong>No results for <strong><?=$_GET['search-item-3'];?></strong></p>
			<?php	
			}
		}
		else {
				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where cat_id = '".$_GET['cat_id']."'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<div class="row">
				<?php
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where cat_id = '".$_GET['cat_id']."'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="admin-item-2.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>		
					<?php
					}
				?>
				</div>
				<?php			
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
		}
	}

	if (isset($_GET['search-order'])) {
		if (!empty($_GET['search-order'])) {
			$cnt_order_query = $conn->query("select count(order_id) as order_id from orders_tbl where order_id like '%".$_GET['search-order']."%'");
			$cnt_order_row = $cnt_order_query->fetch();
	
			if ($cnt_order_row['order_id'] != 0) {
				?>
				<p class="lead"><strong>Results: </strong><?=$cnt_order_row['order_id'];?> results for <strong><?=$_GET['search-order'];?></strong></p>
				<?php
				$cnt_order_query = $conn->query("select count(order_id) as order_id from orders_tbl where order_id like '%".$_GET['search-order']."%' and order_status = 'To be Delivered'");
				$cnt_order_row = $cnt_order_query->fetch();

				if (!empty($cnt_order_row['order_id'])) {
						$order_query = $conn->query("select * from orders_tbl where order_id like '%".$_GET['search-order']."%' and order_status = 'To be Delivered' order by order_added desc");
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
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
						      <a href="../functions/confirm-order.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg btn-info pull-right margin-top">Confirm Order Received <i class="fa fa-check fa-fw"></i></a>
						      <a href="admin-printreceipt.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Print Receipt <i class="fa fa-print fa-fw"></i></a>
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
					$cnt_order_query2 = $conn->query("select count(order_id) as order_id from orders_tbl where order_id like '%".$_GET['search-order']."%' and order_status = 'Finished'");
					$cnt_order_row2 = $cnt_order_query2->fetch();

					if (!empty($cnt_order_row2['order_id'])) {
						$order_query = $conn->query("select * from orders_tbl where order_id like '%".$_GET['search-order']."%' and order_status = 'Finished' order by order_added desc");
						?>
						<h4>Finshed Orders</h4>
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
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
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
			<p class="lead"><strong>Results: </strong>No results for <strong><?=$_GET['search-order'];?></strong></p>
			<?php
			}
		}
		else {
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
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
						      <a href="../functions/confirm-order.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg btn-info pull-right margin-top">Confirm Order Received <i class="fa fa-check fa-fw"></i></a>
						      <a href="admin-printreceipt.php?order_id=<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Print Receipt <i class="fa fa-print fa-fw"></i></a>
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
					$cnt_order_query2 = $conn->query("select count(order_id) as order_id from orders_tbl where order_status = 'Finished'");
					$cnt_order_row2 = $cnt_order_query2->fetch();

					if (!empty($cnt_order_row2['order_id'])) {
						$order_query = $conn->query("select * from orders_tbl where order_status = 'Finished' order by order_added desc");
						?>
						<h4>Finshed Orders</h4>
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
						      <button data-toggle="collapse" data-target="#collapse<?=$order_row['order_id'];?>" class="btn btn-lg  btn-info pull-right margin-top">Details <i class="fa fa-chevron-down fa-fw"></i></button>
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
		              <a href="index.php" class="btn btn-lg btn-info margin-bottom-lg">Continue Shopping <i class="fa fa-chevron-right fa-fw"></i></a>
		            </div>
		          </div>
				<?php
				}
		}
	}

	if (isset($_GET['search-admin'])) {
		if (!empty($_GET['search-admin'])) {
		    	$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Admin'");
				$cnt_acc_row = $cnt_acc_query->fetch();

				if ($cnt_acc_row['acc_id'] != 0) {
		    	$account_query = $conn->query("select * from accounts_tbl inner join admins_tbl on accounts_tbl.acc_id = admins_tbl.acc_id where email like '%".$_GET['search-admin']."%' or firstname like '%".$_GET['search-admin']."%' or lastname like '%".$_GET['search-admin']."%' and acc_type = 'Admin'");
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
				    				if ($account_row['acc_id'] == $admin_row['acc_id']) {
				    				?>
				    				<a class="btn btn-info btn-block disabled"><i class="fa fa-times fa-fw"></i> Deactivate</a>
				    				<?php	
				    				}
				    				else {
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
			    		<td>No admin created yet.</td>
			    	</tr>
			    	<?php
			    }
		}
		else {
			
			    	$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Admin'");
					$cnt_acc_row = $cnt_acc_query->fetch();

					if ($cnt_acc_row['acc_id'] != 0) {
			    	$account_query = $conn->query("select * from accounts_tbl inner join admins_tbl on accounts_tbl.acc_id = admins_tbl.acc_id where acc_type = 'Admin'");
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
				    				if ($account_row['acc_id'] == $admin_row['acc_id']) {
				    				?>
				    				<a class="btn btn-info btn-block disabled"><i class="fa fa-times fa-fw"></i> Deactivate</a>
				    				<?php	
				    				}
				    				else {
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
				    		<td>No admin created yet.</td>
				    	</tr>
				    	<?php
				    }	
		}
	}

	if (isset($_GET['search-seller-2'])) {
		if (!empty($_GET['search-seller-2'])) {
		    	$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Seller'");
				$cnt_acc_row = $cnt_acc_query->fetch();

				if ($cnt_acc_row['acc_id'] != 0) {
		    	$account_query = $conn->query("select * from accounts_tbl inner join sellers_tbl on accounts_tbl.acc_id = sellers_tbl.acc_id where email like '%".$_GET['search-seller-2']."%' or firstname like '%".$_GET['search-seller-2']."%' or lastname like '%".$_GET['search-seller-2']."%' and acc_type = 'Seller'");
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
				    				if ($account_row['acc_id'] == $admin_row['acc_id']) {
				    				?>
				    				<a class="btn btn-info btn-block disabled"><i class="fa fa-times fa-fw"></i> Deactivate</a>
				    				<?php	
				    				}
				    				else {
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
		}
		else {
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
				    				if ($account_row['acc_id'] == $admin_row['acc_id']) {
				    				?>
				    				<a class="btn btn-info btn-block disabled"><i class="fa fa-times fa-fw"></i> Deactivate</a>
				    				<?php	
				    				}
				    				else {
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
		}
	}

	if (isset($_GET['search-user'])) {
		if (!empty($_GET['search-user'])) {
			$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Costumer'");
			$cnt_acc_row = $cnt_acc_query->fetch();

			if ($cnt_acc_row['acc_id'] != 0) {
			    $account_query = $conn->query("select * from accounts_tbl inner join costumers_tbl on accounts_tbl.acc_id = costumers_tbl.acc_id where firstname like '%".$_GET['search-user']."%' or lastname like '%".$_GET['search-user']."%' or email like '%".$_GET['search-user']."%' and acc_type = 'Costumer'");
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
				    				if ($account_row['acc_id'] == $admin_row['acc_id']) {
				    				?>
				    				<a class="btn btn-info btn-block disabled"><i class="fa fa-times fa-fw"></i> Deactivate</a>
				    				<?php	
				    				}
				    				else {
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
				    <td>No user created yet.</td>
				</tr>
				<?php
			}
		}
		else {
			$cnt_acc_query = $conn->query("select count(acc_id) as acc_id from accounts_tbl where acc_type = 'Costumer'");
			$cnt_acc_row = $cnt_acc_query->fetch();

			if ($cnt_acc_row['acc_id'] != 0) {
			    $account_query = $conn->query("select * from accounts_tbl inner join costumers_tbl on accounts_tbl.acc_id = costumers_tbl.acc_id where acc_type = 'Costumer'");
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
				    	<a data-toggle="modal" data-target="#modal-deleteuser<?=$account_row['acc_id'];?>" class="btn btn-info"><i class="fa fa-trash fa-fw"></i> Delete</a>
				    </td>
				</tr>
				<?php include "../modals/delete-admin.php";?>
				<?php	
				}
			}
			else {
				?>
				<tr>
				  	<td>No user created yet.</td>
				</tr>
				<?php
			}
		}
	}

	if (isset($_GET['seller_id']) && isset($_GET['search-item-4'])) {
		if (!empty($_GET['search-item-4'])) {
			$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$_GET['seller_id']."' and name like '%".$_GET['search-item-4']."%'");
			$cnt_item_row = $cnt_item_query->fetch();

			if ($cnt_item_row['item_id'] != 0) {
			?>
			<p class="lead"><strong>Results: </strong><?=$cnt_item_row['item_id'];?> results for <strong><?=$_GET['search-item-4'];?></strong></p>
			<div class="row">
			<?php
				if ($cnt_item_row['item_id'] != 0) {
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where seller_id = '".$_GET['seller_id']."' and name like '%".$_GET['search-item-4']."%'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="seller-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>
					<?php
					}
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
			?>
			</div>
			<?php	
			}
			else {
			?>
			<p class="lead"><strong>Results: </strong>No results for <strong><?=$_GET['search-item-4'];?></strong></p>
			<?php	
			}
		}
		else {

				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$_GET['seller_id']."'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<div class="row">
				<?php
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where seller_id = '".$_GET['seller_id']."'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="seller-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>	
					<?php
					}
				?>
				</div>
				<?php			
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
		}
	}

	if (isset($_GET['seller_id']) && isset($_GET['cat_id']) && isset($_GET['search-item-5'])) {
		if (!empty($_GET['search-item-5'])) {
			$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$_GET['seller_id']."' and cat_id = '".$_GET['cat_id']."' and name like '%".$_GET['search-item-5']."%'");
			$cnt_item_row = $cnt_item_query->fetch();

			if ($cnt_item_row['item_id'] != 0) {
			?>
			<p class="lead"><strong>Results: </strong><?=$cnt_item_row['item_id'];?> results for <strong><?=$_GET['search-item-5'];?></strong></p>
			<div class="row">
			<?php
				if ($cnt_item_row['item_id'] != 0) {
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where seller_id = '".$_GET['seller_id']."' and cat_id = '".$_GET['cat_id']."' and name like '%".$_GET['search-item-5']."%'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="seller-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>
					<?php
					}
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
			?>
			</div>
			<?php	
			}
			else {
			?>
			<p class="lead"><strong>Results: </strong>No results for <strong><?=$_GET['search-item-5'];?></strong></p>
			<?php	
			}
		}
		else {

				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$_GET['seller_id']."' and cat_id = '".$_GET['cat_id']."'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<div class="row">
				<?php
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where seller_id = '".$_GET['seller_id']."' and cat_id = '".$_GET['cat_id']."'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
					?>
					<span id="<?=$item_row['item_id'];?>">
						<div class="col-lg-3 col-sm-3">
						  <div class="panel panel-default panel-hover">
						  	<div class="preview border">
							  	<a href="seller-item.php?item_id=<?=$item_row['item_id'];?>">
							  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
							  	</a>
						  	</div>
						  	<div class="panel-body">
								<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
								<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
						  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
						  	</div>
						  </div>
						</div>  	
					</span>	
					<?php
					}
				?>
				</div>
				<?php			
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
		}
	}

	if (isset($_GET['cos_id']) && isset($_GET['search-convo'])) {
		if (!empty($_GET['search-convo'])) {
				$cnt_seller_query = $conn->query("select count(acc_id) as acc_id from sellers_tbl where firstname like '%".$_GET['search-convo']."%' or lastname like '%".$_GET['search-convo']."%'");
				$cnt_seller_row = $cnt_seller_query->fetch();

				if ($cnt_seller_row['acc_id'] != 0) {
					$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id where firstname like '%".$_GET['search-convo']."%' or lastname like '%".$_GET['search-convo']."%' order by firstname asc limit 10");
					while ($seller_row = $seller_query->fetch()) {
						$th_query = $conn->query("select * from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$_GET['cos_id']."' and th_status = 'Unread'");
						$th_row = $th_query->fetch();

						$cnt_unread_query = $conn->query("select count(th_id) as th_id from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$_GET['cos_id']."' and th_status = 'Unread'");
						$cnt_unread_row = $cnt_unread_query->fetch();

						if ($cnt_unread_row['th_id'] != 0) {
							if (!empty($_GET['seller_id'])) {						
								if ($_GET['seller_id'] == $seller_row['acc_id']) {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php
								}
								else {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php
								}
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php		
							}
						}
						else {
							if (!empty($_GET['seller_id'])) {						
								if ($_GET['seller_id'] == $seller_row['acc_id']) {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php
								}
								else {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php
								}
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php		
							}
						}
					}
				}
				else {
				?>
				<p class="lead text-center">No results for <strong><?=$_GET['search-convo'];?></strong>.</p>
				<?php
				}
		}
		else {
				$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id order by firstname asc limit 10");
				while ($seller_row = $seller_query->fetch()) {
					$th_query = $conn->query("select * from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$_GET['cos_id']."' and th_status = 'Unread'");
					$th_row = $th_query->fetch();
					$cnt_unread_query = $conn->query("select count(th_id) as th_id from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$_GET['cos_id']."' and th_status = 'Unread'");
					$cnt_unread_row = $cnt_unread_query->fetch();

					if ($cnt_unread_row['th_id'] != 0) {
						if (!empty($_GET['seller_id'])) {						
							if ($_GET['seller_id'] == $seller_row['acc_id']) {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
						}
						else {
						?>
						<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php		
						}
					}
					else {
						if (!empty($_GET['seller_id'])) {						
							if ($_GET['seller_id'] == $seller_row['acc_id']) {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
						}
						else {
						?>
						<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php		
						}
					}
				}
		}
	}
	if (isset($_GET['seller_id']) && isset($_GET['search-convo-2'])) {
		if (!empty($_GET['search-convo-2'])) {
			$cnt_seller_query = $conn->query("select count(seller) as seller from messages_tbl where seller = '".$_GET['seller_id']."'");
			$cnt_seller_row = $cnt_seller_query->fetch();

			if ($cnt_seller_row['seller'] != 0) {
				$convo_query = $conn->query("select * from messages_tbl inner join costumers_tbl on messages_tbl.costumer=costumers_tbl.acc_id where seller = '".$_GET['seller_id']."' and firstname like '%".$_GET['search-convo-2']."%' or lastname like '%".$_GET['search-convo-2']."%' limit 10");
					while ($convo_row = $convo_query->fetch()) {
						$th_query = $conn->query("select * from threads_tbl where sender = '".$convo_row['acc_id']."' and receiver = '".$_GET['seller_id']."' and th_status = 'Unread'");
						$th_row = $th_query->fetch();
						$cnt_unread_query = $conn->query("select count(th_id) as th_id from threads_tbl where sender = '".$convo_row['acc_id']."' and receiver = '".$_GET['seller_id']."' and th_status = 'Unread'");
						$cnt_unread_row = $cnt_unread_query->fetch();
						
						if ($cnt_unread_row['th_id'] != 0) {
							if (!empty($_GET['cos_id'])) {
								if ($_GET['cos_id'] == $cos_row['acc_id']) {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$convo_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$convo_row['firstname'];?> <?=$convo_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php	
								}
								else {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$convo_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$convo_row['firstname'];?> <?=$convo_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php	
								}
							}
							else {
							?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$convo_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$convo_row['firstname'];?> <?=$convo_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php	
							}
						}
						else {
						?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$convo_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$convo_row['firstname'];?> <?=$convo_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php	
						}
					}
			}
			else {
			?>
			<p class="lead text-center">No results for <strong><?=$_GET['search-convo-2'];?></strong>.</p>
			<?php
			}
		}
		else {
					$convo_query = $conn->query("select * from messages_tbl where seller = '".$_GET['seller_id']."' limit 10");
					while ($convo_row = $convo_query->fetch()) {
						$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$convo_row['costumer']."'");
						$cos_row = $cos_query->fetch();

						$th_query = $conn->query("select * from threads_tbl where sender = '".$cos_row['acc_id']."' and receiver = '".$_GET['seller_id']."' and th_status = 'Unread'");
						$th_row = $th_query->fetch();
						$cnt_unread_query = $conn->query("select count(th_id) as th_id from threads_tbl where sender = '".$cos_row['acc_id']."' and receiver = '".$_GET['seller_id']."' and th_status = 'Unread'");
						$cnt_unread_row = $cnt_unread_query->fetch();

						if ($cnt_unread_row['th_id'] != 0) {
							if (!empty($_GET['cos_id'])) {
								if ($_GET['cos_id'] == $cos_row['acc_id']) {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$cos_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block active"><span class="pull-left"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php	
								}
								else {
								?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$cos_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
								<?php	
								}
							}
							else {
							?>
								<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$cos_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php	
							}
						}
						else {
						?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&cos_id=<?=$cos_row['acc_id'];?>" style="height: 45px;" class="btn btn-info btn-lg btn-block"><span class="pull-left"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php	
						}
					}
		}
	}
?>