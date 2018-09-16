<?php
	include "config.php";

	if (isset($_GET['cat_id'])) {
		$get_cat_query = $conn->query("select * from categories_tbl where cat_id = '".$_GET['cat_id']."'");
		$get_cat_row = $get_cat_query->fetch();

		$delete_query = $conn->query("delete from categories_tbl where cat_id = '".$_GET['cat_id']."'");
		$delete_query2 = $conn->query("delete from items_tbl where cat_id = '".$_GET['cat_id']."'");
	}
	if (isset($_GET['item_id'])) {
		$get_item_query = $conn->query("select * from items_tbl where item_id = '".$_GET['item_id']."'");
		$get_item_row = $get_item_query->fetch();
		unlink($get_item_row['item_photo']);

		$delete_query = $conn->query("delete from items_tbl where item_id = '".$_GET['item_id']."'");
		$delete_query2 = $conn->query("delete from items_quantity_tbl where item_id = '".$_GET['item_id']."'");
		$delete_query3 = $conn->query("delete from item_features_tbl where item_id = '".$_GET['item_id']."'");
		$delete_query4 = $conn->query("delete from carts_tbl where item_id = '".$_GET['item_id']."'");
		$delete_query6 = $conn->query("delete from orders_items_tbl where item_id = '".$_GET['item_id']."'");
		?>
		<div class="alert alert-success padding-lg">
			<strong><i class="fa fa-check fa-fw"></i></strong> Item '<?=$get_item_row['name'];?>' has been deleted. <a href="seller-inventory.php"><strong>Click to Return</strong></a>
		</div>
		<?php
	}
	if (isset($_GET['acc_id']) && isset($_GET['acc_type'])) {
		$delete_query = $conn->query("delete from accounts_tbl where acc_id = '".$_GET['acc_id']."'");
		if ($_GET['acc_type'] == "Admin") {
			$delete_query2 = $conn->query("delete from admins_tbl where acc_id = '".$_GET['acc_id']."'");
		}
		else if ($_GET['acc_type'] == "Seller") {
			$delete_query2 = $conn->query("delete from sellers_tbl where acc_id = '".$_GET['acc_id']."'");
			$delete_query3 = $conn->query("delete from items_tbl where seller_id = '".$_GET['acc_id']."'");
			$delete_query4 = $conn->query("delete from messages_tbl where seller = '".$_GET['acc_id']."'");
			$delete_query5 = $conn->query("delete from threads_tbl where receiver = '".$_GET['acc_id']."'");
			$delete_query6 = $conn->query("delete from threads_tbl where sender = '".$_GET['acc_id']."'");
		}
		else if ($_GET['acc_type'] == "Costumer") {
			$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$_GET['acc_id']."'");
			$cos_row = $cos_query->fetch();

			unlink($cos_row['profile_photo']);
			$delete_query2 = $conn->query("delete from costumers_tbl where acc_id = '".$_GET['acc_id']."'");
			$delete_query3 = $conn->query("delete from carts_tbl where acc_id = '".$_GET['acc_id']."'");
			$delete_query4 = $conn->query("delete from wishlists_tbl where acc_id = '".$_GET['acc_id']."'");
			$delete_query5 = $conn->query("delete from orders_tbl where acc_id = '".$_GET['acc_id']."'");
			$delete_query6 = $conn->query("delete from messages_tbl where costumer = '".$_GET['acc_id']."'");
			$delete_query7 = $conn->query("delete from threads_tbl where receiver = '".$_GET['acc_id']."'");
			$delete_query8 = $conn->query("delete from threads_tbl where sender = '".$_GET['acc_id']."'");
		}
	}
	if (isset($_GET['cart_id'])) {
		$cart_query = $conn->query("select * from carts_tbl where cart_id = '".$_GET['cart_id']."'");
		$cart_row = $cart_query->fetch();
		$get_item_query = $conn->query("select * from items_tbl where item_id = '".$cart_row['item_id']."'");
		$get_item_row = $get_item_query->fetch();

		$delete_query = $conn->query("delete from carts_tbl where cart_id = '".$_GET['cart_id']."'");
		?>
		<div class="alert alert-success padding-lg">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><i class="fa fa-check fa-fw"></i></strong> Item '<?=$get_item_row['name'];?>' has been removed to your cart.</a>
		</div>
		<?php
	}

	if (isset($_GET['unit_id'])) {
		$delete_query = $conn->query("delete from units_tbl where unit_id = '".$_GET['unit_id']."'");
	}

	if (isset($_GET['mes_id'])) {
		$delete_query = $conn->query("delete from threads_tbl where mes_id = '".$_GET['mes_id']."'");
	}
?>