<?php
	include "config.php";

	if (isset($_GET['acc_id']) && isset($_GET['payment_type'])) {
		$cnt_cart_query = $conn->query("select count(cart_id) as cart_id from carts_tbl where acc_id = '".$_GET['acc_id']."' and cart_status = 'Pending'");
		$cnt_cart_row = $cnt_cart_query->fetch();

		if ($cnt_cart_row != 0) {
			$cart_total = 0;
			$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
			while($item_row = $item_query->fetch()) {
				$cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$_GET['acc_id']."' and cart_status = 'Pending'");
				while($cart_row = $cart_query->fetch()) {
					$total_price = str_replace(",", "", $cart_row['total_price']);
					$cart_total += $total_price;

					$update_query = $conn->prepare("update items_quantity_tbl set quantity = :quantity where item_id = :item_id");
					$update_query->bindParam(":quantity", $new_quantity);
					$update_query->bindParam(":item_id", $cart_row['item_id']);
					$new_quantity = $item_row['quantity'] - $cart_row['quantity'];	
					$update_query->execute();
				}
			}
			$fee_query = $conn->query("select * from fees_tbl");
			$fee_row = $fee_query->fetch();
			$order_price = $cart_total + $fee_row['service_fee'] + $fee_row['delivery_fee'];

			$save_query = $conn->prepare("insert into orders_tbl(acc_id, order_price, order_deliverydate, order_status, payment_type)values(:acc_id, :order_price, :order_deliverydate, :order_status, :payment_type)");
			$save_query->bindParam(":acc_id", $_GET['acc_id']);
			$save_query->bindParam(":order_price", $order_price);
			$save_query->bindParam(":order_deliverydate", $order_deliverydate);
			$save_query->bindParam(":order_status", $order_status);
			$save_query->bindParam(":payment_type", $_GET['payment_type']);
			$date = strtotime("+4 Days");
			$order_deliverydate = date("Y-m-d h:i:sa", $date);
			$order_status = "To be Delivered";

			if ($save_query->execute()) {
				$order_id = $conn->lastInsertId();
				$get_item_query = $conn->query("select * from carts_tbl where cart_status = 'Pending' and acc_id = '".$_GET['acc_id']."'");
				while ($get_item_row = $get_item_query->fetch()) {
					$save_query = $conn->prepare("insert into orders_items_tbl (order_id, item_id)values(:order_id, :item_id)");
					$save_query->bindParam(":order_id", $order_id);
					$save_query->bindParam(":item_id", $get_item_row['item_id']);
					$save_query->execute();
				}
				$update_query2 = $conn->prepare("update carts_tbl set cart_status = :cart_status where acc_id = :acc_id");
				$update_query2->bindParam(":cart_status", $cart_status);
				$update_query2->bindParam(":acc_id", $_GET['acc_id']);
				$cart_status = "Checkout";
				if ($update_query2->execute()) {
				?>
				<div class="panel panel-default">
		            <div class="panel-body text-center">
		              <i class="fa fa-check fa-fw fa-10x margin-top-lg margin-bottom-lg"></i>
		              <p class="lead">Your order has been confirmed. To track your recent order, just go to orders page. Thanks for shopping!</p>
		              <a href="index.php" class="btn btn-lg btn-success margin-bottom-lg">Continue Shopping <i class="fa fa-chevron-right fa-fw"></i></a>
		              <a href="cos-order.php" class="btn btn-lg btn-success margin-bottom-lg"> Check Order <i class="fa fa-calendar-plus fa-fw"></i></a>
		            </div>
		        </div>
				<?php
				}
			}
		}
		else {
		?>
		<script type="text/javascript">
			window.location.assign("../costumers/index.php");
		</script>
		<?php
		}

	}
?>