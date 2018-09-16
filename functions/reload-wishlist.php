<?php
	include "config.php";

	if (isset($_GET['acc_id']) && isset($_GET['item_id'])) {
		$wish_query = $conn->query("select count(wish_id) as wish_id from wishlists_tbl where acc_id = '".$_GET['acc_id']."' and item_id = '".$_GET['item_id']."'");
		$wish_row = $wish_query->fetch();
		
		if ($wish_row['wish_id'] != 0) {
		?>
		<i class="fa fa-heart fa-fw" style="color: #DC4C46;"></i>
		<?php
		}
	}
?>