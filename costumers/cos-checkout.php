<?php include "../functions/account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkouts &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "cos-navbar.php";?>
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
	<h3><i class="fa fa-shopping-bag fa-fw"></i> Checkouts</h3>
	<hr>
	<?php
		$cnt_cart_query = $conn->query("select count(cart_id) as cart_id from carts_tbl where acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
		$cnt_cart_row = $cnt_cart_query->fetch();

		if ($cnt_cart_row['cart_id'] != 0) {
		?>
		<span id="checkout-response">
		<div class="row">
			<div class="col-lg-8 col-sm-8">
				<div class="panel-group">
		        <?php
		          $cart_total = 0;
		          $item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
		          while($item_row = $item_query->fetch()) {
		            $cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
		            while($cart_row = $cart_query->fetch()) {
		              $cart_total += $cart_row['total_price'];
		          ?>
		          <span id="updatecart-response<?=$item_row['item_id'];?>">
		            <input type="hidden" name="cart_id" value="<?=$cart_row['cart_id'];?>">
		            <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
		            <div class="panel panel-default">
		              <div class="panel-body">
		                <div class="row">
		                 <div class="col-lg-3 col-lg-3">
		                    <div class="border" style="height: 130px; overflow: hidden;">
		                      <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
		                    </div>
		                 </div>
		                 <div class="col-lg-5 col-lg-5">
		                    <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
		                      <p class="text-small text-muted margin-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
		                      <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
		                      <p class="text-left"><strong>Items Left:</strong> <?=$item_row['quantity'];?> Items</p>
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
		              </div>
		            </div>
		          </span>
		          <?php  
		            }
		          }
		        ?>
		        </div>
			</div>
			<div class="col-lg-4 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3 class="margin-top-sm margin-bottom-lg">Order Summary</h3>
						<?php
				        	$cart_total = 0;
				        	$cnt_cart_query = $conn->query("select count(cart_id) as cart_id from carts_tbl where acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
				        	$cnt_cart_row = $cnt_cart_query->fetch();
							$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
						    while($item_row = $item_query->fetch()) {
						        $cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
						        while($cart_row = $cart_query->fetch()) {
						            $total_price = str_replace(",", "", $cart_row['total_price']);
						            $cart_total += $total_price;
						        }
						    }
						    $fee_query = $conn->query("select * from fees_tbl");
						    $fee_row = $fee_query->fetch();

						    $total_payment = $cart_total + $fee_row['service_fee'] + $fee_row['delivery_fee'];
						?>
				        <p><span class="pull-left"><strong>Cart Total:</strong> (<?=$cnt_cart_row['cart_id'];?> Items)</span>
						<span class="pull-right">P<?php echo number_format($cart_total, 2);?></span>
						</p>
						<div class="clearfix"></div>
						<p><strong class="pull-left">Service Fee:</strong> <span class="pull-right">P<?php echo number_format($fee_row['service_fee'], 2);?></span></p>
						<div class="clearfix"></div>
						<p><strong class="pull-left">Delivery Fee:</strong><span class="pull-right">P<?php echo number_format($fee_row['delivery_fee'], 2);?></span></p>
						<div class="clearfix padding-bottom border-bottom"></div>
						<p><strong class="pull-left">Total Payment:</strong><span class="pull-right">P<?php echo number_format($total_payment, 2);?></span></p>
						<div class="clearfix"></div>
						<hr>
						<h4 class="margin-top-sm margin-bottom">Payment Via</h4>
						<?php
							$del_query = $conn->query("select * from deliverydetails_tbl where acc_id = '".$cos_row['acc_id']."'");
							$del_row = $del_query->fetch();

							if ($del_row['acc_id'] == $cos_row['acc_id']) {
							?>
							<button class="btn  btn-success btn-block" onclick="load_process('checkout-response', '../functions/save-order.php?acc_id=<?=$cos_row['acc_id'];?>&payment_type=COD')">Cash on Delivery <i class="fa fa-truck fa-fw"></i></button>
							<button class="btn  btn-success btn-block">Unionbank</button>
							<?php	
							}
							else if ($del_row['acc_id'] != $cos_row['acc_id']) {
							?>
							<button class="btn  btn-success btn-block disabled">Cash on Delivery <i class="fa fa-truck fa-fw"></i></button>
							<button class="btn  btn-success btn-block disabled">Unionbank</button>
							<?php
							}
						?>					
						<p class="text-small text-muted">*Delivery of orders are within 2-5 days span.</p>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<h3 class="margin-top-sm margin-bottom-lg">Delivery Details</h3>
						<?php
							if ($del_row['acc_id'] == $cos_row['acc_id']) {
							?>
							<p><strong>Mobile Number: </strong> <?=$del_row['mobile_number'];?></p>
							<p><strong>Telephone Number: </strong> <?=$del_row['telephone_number'];?></p>
							<p><strong>Address: </strong> <?=$del_row['address'];?></p>
							<p><strong>Address Details: </strong> <?=$del_row['address_details'];?></p>
							<a href="cos-profile.php" class="btn  btn-warning">Update Details <i class="fa fa-edit fa-fw"></i></a>
							<?php	
							}
							else if ($del_row['acc_id'] != $cos_row['acc_id']) {
							?>
							<p class="lead">Please enter your delivery details first before confirming your order.</p>
							<a href="cos-profile.php" class="btn  btn-warning">Update Details <i class="fa fa-edit fa-fw"></i></a>
							<?php
							}
						?>
					</div>
				</div>		
			</div>
		</div>
		</span>
		<?php	
		}
		else {
		?>
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
              <p class="lead">You must select your items before checking out.</p>
              <a href="index.php" class="btn  btn-warning margin-bottom-lg">Continue Shopping <i class="fa fa-chevron-right fa-fw"></i></a>
            </div>
          </div>
		<?php	
		}
	?>
</div>
<?php include "cos-footer.php";?>

</body>
</html>