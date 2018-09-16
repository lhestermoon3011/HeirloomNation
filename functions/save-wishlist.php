<?php
	include "config.php";
	include "account-session.php";

	if (isset($_GET['item_id'])) {
		$wish_query = $conn->query("select count(wish_id) as wish_id from wishlists_tbl where acc_id = '".$cos_row['acc_id']."' and item_id = '".$_GET['item_id']."'");
		$wish_row = $wish_query->fetch();

		if ($wish_row['wish_id'] == 0) {
			$save_query = $conn->prepare("insert into wishlists_tbl (acc_id, item_id)values(:acc_id, :item_id)");
			$save_query->bindParam(":acc_id", $cos_row['acc_id']);
			$save_query->bindParam(":item_id", $_GET['item_id']);

			if ($save_query->execute()) {
			?>
			<i class="fa fa-heart fa-fw" style="color: #DC4C46;"></i> Remove to Wishlist
			<?php	
			}
		}
		else {
			$delete_query = $conn->query("delete from wishlists_tbl where item_id = '".$_GET['item_id']."' and acc_id = '".$cos_row['acc_id']."'");
			?>
			<i class="fa fa-heart fa-fw""></i> Add to Wishlist
			<?php
		}
	}
?>