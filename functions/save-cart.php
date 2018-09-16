<?php
	include "config.php";

	if (isset($_POST)) {
		$item_query = $conn->query("select * from items_tbl where item_id = '".$_POST['item_id']."'");
		$item_row = $item_query->fetch();

		$save_query = $conn->prepare("insert into carts_tbl (acc_id, item_id, quantity, total_price, cart_status)values(:acc_id, :item_id, :quantity, :total_price, :cart_status)");
		$save_query->bindParam(":acc_id", $_POST['acc_id']);
		$save_query->bindParam(":item_id", $_POST['item_id']);
		$save_query->bindParam(":quantity", $_POST['quantity']);
		$save_query->bindParam(":total_price", $total_price);
		$save_query->bindParam(":cart_status", $cart_status);
		$total_price = number_format($_POST['quantity'] * $item_row['price'], 2);
		$cart_status = "Pending";

		if ($save_query->execute()) {
		?>
		<script type="text/javascript">
			window.location.assign("../costumers/index.php");
		</script>
		<?php
		}
	}
?>