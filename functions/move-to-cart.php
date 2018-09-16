<?php
	include "config.php";
	include "account-session.php";

	if (isset($_GET['item_id'])) {
		$item_query = $conn->query("select * from items_tbl where item_id = '".$_GET['item_id']."'");
		$item_row = $item_query->fetch();

		$save_query = $conn->prepare("insert into carts_tbl (acc_id, item_id, quantity, total_price, cart_status)values(:acc_id, :item_id, :quantity, :total_price, :cart_status)");
		$save_query->bindParam(":acc_id", $cos_row['acc_id']);
		$save_query->bindParam(":item_id", $_GET['item_id']);
		$save_query->bindParam(":quantity", $quantity);
		$save_query->bindParam(":total_price", $item_row['price']);
		$save_query->bindParam(":cart_status", $cart_status);
		$quantity = "1";
		$cart_status = "Pending";

		if ($save_query->execute()) {
		?>
		<div class="alert alert-success padding-lg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-check fa-fw"></i></strong> Item '<?=$item_row['name'];?>' has been moved to your cart.</a>
		</div>
		<?php
		}
	}
?>